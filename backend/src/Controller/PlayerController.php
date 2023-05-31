<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Player;

class PlayerController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/player', name: 'app_player', methods: ['POST'])]
    public function read(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $id = $requestData['id'];

        $player = $this->entityManager->getRepository(Player::class)->find($id);

        if (!$player) {
            return $this->json(['message' => 'Player not found'], Response::HTTP_NOT_FOUND);
        }

        $data = [
            'name' => $player->getName(),
            'surname' => $player->getSurname(),
        ];

        return $this->json($data, Response::HTTP_OK);
    }
}