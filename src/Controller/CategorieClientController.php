<?php

namespace App\Controller;

use App\Repository\CategorieClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieClientController extends AbstractController
{
    #[Route('/api/categorieclient', name: 'getAllCatagorieClient', methods: ['GET'])]
    public function getAllCatagorieClient(
        CategorieClientRepository $categorieClientRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $lesCatagoriesClients = $categorieClientRepository->findAll();

        $jsonLesCatagoriesClients = $serializer->serialize($lesCatagoriesClients, "json", ['groups' => 'getAllCategorieClient']);

        return new JsonResponse($jsonLesCatagoriesClients, Response::HTTP_OK, [], true);
    }

    #[Route('/api/categorieclient/{id}', name: 'detailCategorieClient', methods: ['GET'])]
    public function getDetailCategorieClient(int $id, CategorieClientRepository $categorieClientRepository, SerializerInterface $serializer): JsonResponse
    {
        $CategorieClient = $categorieClientRepository->find($id);

        $jsonCategorieClient = $serializer->serialize($CategorieClient, 'json', ['groups' => 'getAllCategorieClient']);
        return new JsonResponse($jsonCategorieClient, Response::HTTP_OK, [], true);
    }


}
