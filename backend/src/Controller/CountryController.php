<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Country;

class CountryController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/countries', name: 'list_countries', methods: ['GET'])]
    public function listCountries(): JsonResponse
    {
        $countries = $this->entityManager->getRepository(Country::class)->findAll();
        $data = [];

        foreach ($countries as $country) {
            $hasTeam = $country->getTeam() ? true : false;

            $data[] = [
                'id' => $country->getId(),
                'name' => $country->getName(),
                'flag_file' => $country->getFlagFile(),
                'has_team' => $hasTeam,
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }

    #[Route('/countries', name: 'create_country', methods: ['POST'])]
    public function createCountry(Request $request): JsonResponse
    {
        $name = $request->request->get('name');
        $flagFile = $request->request->get('flag_file');

        $existingCountry = $this->entityManager->getRepository(Country::class)->findOneBy(['name' => $name]);

        if ($existingCountry) {
            return $this->json(['message' => 'Country with the given name already exists'], Response::HTTP_CONFLICT);
        }

        $country = new Country();
        $country->setName($name);
        $country->setFlagFile($flagFile);

        $entityManager = $this->entityManager;
        $entityManager->persist($country);
        $entityManager->flush();

        return $this->json(['message' => 'Country created successfully'], Response::HTTP_CREATED);
    }
}