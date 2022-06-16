<?php

namespace App\Controller;

use App\Repository\FamilleProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FamilleProduitController extends AbstractController
{
    #[Route('/api/familleproduit', name: 'app_familleproduit', methods: ['GET'])]
    public function getAllFamilleProduit(FamilleProduitRepository $familleProduitRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesFamillesProduits= $familleProduitRepository->findAll();

        $jsonLesFamillesProduits = $serializer->serialize($lesFamillesProduits, "json", 
        ['groups' => 'getAllFamilleProduit']);

        return new JsonResponse($jsonLesFamillesProduits, Response::HTTP_OK, [], true);
    }
}

