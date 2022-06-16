<?php

namespace App\Controller;

use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class VenteController extends AbstractController
{
    #[Route('/api/vente', name: 'app_vente', methods: ['GET'])]
    public function getAllVente(VenteRepository $venteRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesVente = $venteRepository->findAll();

        $jsonLesVente = $serializer->serialize($lesVente, "json", 
        ['groups' => 'getAllVente']);

        return new JsonResponse($jsonLesVente, Response::HTTP_OK, [], true);
    }
}
