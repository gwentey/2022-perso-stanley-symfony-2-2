<?php

namespace App\Controller;

use App\Repository\ProductionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductionController extends AbstractController
{
    #[Route('/api/production', name: 'app_production', methods: ['GET'])]
    public function getAllProduction(ProductionRepository $productionRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesProduction = $productionRepository->findAll();

        $jsonLesProduction = $serializer->serialize($lesProduction, "json",  ['groups' => 'getAllProduction']);

        return new JsonResponse($jsonLesProduction, Response::HTTP_OK, [], true);
    }
}


