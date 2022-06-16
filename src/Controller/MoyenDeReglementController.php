<?php

namespace App\Controller;

use App\Repository\MoyenDeReglementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MoyenDeReglementController extends AbstractController
{
    #[Route('/api/moyendereglement', name: 'app_moyendereglement', methods: ['GET'])]
    public function getAllMoyenDeReglement(MoyenDeReglementRepository $moyenDeReglementRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesMoyenDeReglement = $moyenDeReglementRepository->findAll();

        $jsonLesMoyenDeReglement = $serializer->serialize($lesMoyenDeReglement, "json", 
        ['groups' => 'getAllMoyenDeReglement']);

        return new JsonResponse($jsonLesMoyenDeReglement, Response::HTTP_OK, [], true);
    }
}

