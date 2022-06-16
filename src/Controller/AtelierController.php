<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AtelierController extends AbstractController
{
    #[Route('/api/atelier', name: 'app_atelier')]
    public function getAllAtelier(AtelierRepository $atelierRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesAteliers = $atelierRepository->findAll();

        $jsonLesAteliers = $serializer->serialize($lesAteliers, "json", ['groups' => 'getAllAtelier']);

        return new JsonResponse($jsonLesAteliers, Response::HTTP_OK, [], true);
    }
}
