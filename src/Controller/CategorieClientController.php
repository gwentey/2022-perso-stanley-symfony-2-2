<?php

namespace App\Controller;

use App\Entity\CategorieClient;
use App\Repository\CategorieClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieClientController extends AbstractController
{
    #[Route('/api/categorieclient', name: 'app_categorie_client', methods: ['GET'])]
    public function getAllCatagorieClient(CategorieClientRepository $categorieClientRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesCatagoriesClients = $categorieClientRepository->findAll();

        $jsonLesCatagoriesClients = $serializer->serialize($lesCatagoriesClients, "json", ['groups' => 'getAllCategorieClient']);

        return new JsonResponse($jsonLesCatagoriesClients, Response::HTTP_OK, [], true);
    }
}
