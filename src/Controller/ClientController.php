<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ClientController extends AbstractController
{
    #[Route('/api/client', name: 'app_client', methods: ['GET'])]
    public function getAllClient(ClientRepository $clientRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesClients = $clientRepository->findAll();

        $jsonLesClients = $serializer->serialize($lesClients, "json", ['groups' => 'getAllClient']);

        return new JsonResponse($jsonLesClients, Response::HTTP_OK, [], true);
    }
}
