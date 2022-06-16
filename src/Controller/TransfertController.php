<?php

namespace App\Controller;

use App\Repository\TransfertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TransfertController extends AbstractController
{
    #[Route('/api/transfert', name: 'app_transfert', methods: ['GET'])]
    public function getAllTransfert(TransfertRepository $transfertRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesTransfert = $transfertRepository->findAll();

        $jsonLesTransfert = $serializer->serialize($lesTransfert, "json",  ['groups' => 'getAllTransfert']);

        return new JsonResponse($jsonLesTransfert, Response::HTTP_OK, [], true);
    }
}


