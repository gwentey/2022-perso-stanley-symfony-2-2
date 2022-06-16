<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ClasseController extends AbstractController
{
    #[Route('/api/classe', name: 'app_classe', methods: ['GET'])]
    public function getAllClasse(ClasseRepository $classeRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesClasses = $classeRepository->findAll();

        $jsonLesClasses = $serializer->serialize($lesClasses, "json", ['groups' => 'getAllClasse']);

        return new JsonResponse($jsonLesClasses, Response::HTTP_OK, [], true);
    }
}
