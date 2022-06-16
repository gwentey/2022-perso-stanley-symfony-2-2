<?php

namespace App\Controller;

use App\Repository\DestructionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DestructionController extends AbstractController
{
    #[Route('/api/destruction', name: 'app_destruction', methods: ['GET'])]
    public function getAllClient(DestructionRepository $destructionRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesDestructions = $destructionRepository->findAll();

        $jsonLesDestructions = $serializer->serialize($lesDestructions, "json", ['groups' => 'getAllDestruction']);

        return new JsonResponse($jsonLesDestructions, Response::HTTP_OK, [], true);
    }
}
