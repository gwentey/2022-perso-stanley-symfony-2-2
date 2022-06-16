<?php

namespace App\Controller;

use App\Repository\UniteeProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UniteeProduitController extends AbstractController
{
    #[Route('/api/uniteeproduit', name: 'app_unitee_produit')]
    public function getAllUniteeProduit(UniteeProduitRepository $uniteeProduitRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesUniteeProduit = $uniteeProduitRepository->findAll();

        $jsonLesUniteeProduit = $serializer->serialize($lesUniteeProduit, "json");

        return new JsonResponse($jsonLesUniteeProduit, Response::HTTP_OK, [], true);
    }
}
