<?php

namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProfesseurController extends AbstractController
{
    #[Route('/api/professeur', name: 'app_professeur', methods: ['GET'])]
    public function getAllProfesseur(ProfesseurRepository $professeurRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesProfesseur = $professeurRepository->findAll();

        $jsonLesProfesseur = $serializer->serialize($lesProfesseur, "json",  ['groups' => 'getAllProfesseur']);

        return new JsonResponse($jsonLesProfesseur, Response::HTTP_OK, [], true);
    }
}


