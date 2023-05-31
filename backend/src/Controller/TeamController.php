<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;

use App\Entity\Country;
use App\Entity\Player;
use App\Entity\Team;

class TeamController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/teams/all', name: 'all_teams', methods: ['GET'])]
    public function allTeams(Request $request): JsonResponse
    {
        $teams = $this->entityManager->getRepository(Team::class)->findAll();
        $data = [];

        foreach ($teams as $team) {
            $data[] = [
                'id' => $team->getId(),
                'name' => $team->getName()
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }

    #[Route('/teams', name: 'list_teams', methods: ['GET'])]
    public function listTeams(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 3);

        $query = $this->entityManager->getRepository(Team::class)
            ->createQueryBuilder('t')
            ->leftJoin('t.players', 'p')
            ->addSelect('p')
            ->getQuery();

        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $data = [];
        foreach ($paginator as $team) {
            $players = $team->getPlayers();

            $playerData = [];
            foreach ($players as $player) {
                $playerData[] = [
                    'id' => $player->getId(),
                    'name' => $player->getName(),
                    'surname' => $player->getSurname(),
                ];
            }

            $data[] = [
                'id' => $team->getId(),
                'name' => $team->getName(),
                'money_balance' => $team->getMoneyBalance(),
                'country' => [
                    'name' => $team->getCountry()->getName(),
                    'flag_file' => $team->getCountry()->getFlagFile(),
                ],
                'players' => $playerData,
            ];
        }

        $totalItems = count($paginator);
        $totalPages = ceil($totalItems / $limit);

        $pagination = [
            'page' => $page,
            'limit' => $limit,
            'total_items' => $totalItems,
            'total_pages' => $totalPages,
        ];

        $response = [
            'data' => $data,
            'pagination' => $pagination,
        ];

        return $this->json($response, Response::HTTP_OK);
    }

    #[Route('/teams', name: 'create_team', methods: ['POST'])]
    public function createTeam(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $name = $requestData['name'];
        $moneyBalance = $requestData['money_balance'];
        $countryId = $requestData['country_id'];
        $players = $requestData['players'];

        $entityManager = $this->entityManager;
        $country = $entityManager->getRepository(Country::class)->find($countryId);

        if (!$country || $country->getTeam()) {
            return $this->json(['message' => 'Invalid country supplied'], Response::HTTP_BAD_REQUEST);
        }

        $existingTeam = $entityManager->getRepository(Team::class)->findOneBy(['name' => $name]);

        if ($existingTeam) {
            return $this->json(['message' => 'Team with the given name already exists'], Response::HTTP_CONFLICT);
        }

        $team = new Team();
        $team->setName($name);
        $team->setMoneyBalance($moneyBalance);
        $team->setCountry($country);

        foreach ($players as $playerData) {
            $player = new Player();
            $player->setName($playerData['name']);
            $player->setSurname($playerData['surname']);
            $player->setTeam($team);
    
            $entityManager->persist($player);
        }

        $entityManager->persist($team);
        $entityManager->flush();

        return $this->json(['message' => 'Team created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/teams/transfer-player', name: 'transfer_player', methods: ['POST'])]
    public function transferPlayer(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $fromTeamId = $requestData['from_team'];
        $toTeamId = $requestData['to_team'];
        $playerId = $requestData['player'];
        $amount = $requestData['amount'];

        $entityManager = $this->entityManager;

        $fromTeam = $entityManager->getRepository(Team::class)->find($fromTeamId);
        $toTeam = $entityManager->getRepository(Team::class)->find($toTeamId);
        $player = $entityManager->getRepository(Player::class)->find($playerId);

        if (!$fromTeam || !$toTeam || !$player) {
            return new JsonResponse(['message' => 'Invalid team or player supplied'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($toTeam->getMoneyBalance() < $amount) {
            return new JsonResponse(['message' => 'Insufficient funds'], JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($fromTeam->getId() === $toTeam->getId()) {
            return new JsonResponse(['message' => 'Team cannot buy and sell at the same time'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $player->setTeam($toTeam);
        $fromTeam->setMoneyBalance($fromTeam->getMoneyBalance() + $amount);
        $toTeam->setMoneyBalance($toTeam->getMoneyBalance() - $amount);

        $entityManager->flush();

        return new JsonResponse(['message' => 'Player transfer successful'], JsonResponse::HTTP_OK);
    }
}