<?php

namespace App\Controller;

use App\Repository\DestructionRepository;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FactureController extends AbstractController
{
    #[Route('/api/facture', name: 'app_facture', methods: ['GET'])]
    public function getAllClient(FactureRepository $factureRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesFactures = $factureRepository->findAll();

        $jsonLesFactures = $serializer->serialize($lesFactures, "json", ['groups' => 'getAllFacture']);

        return new JsonResponse($jsonLesFactures, Response::HTTP_OK, [], true);
    }
}

