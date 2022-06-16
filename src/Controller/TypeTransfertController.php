<?php

namespace App\Controller;

use App\Repository\TypeTransfertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TypeTransfertController extends AbstractController
{
    #[Route('/api/typetransfert', name: 'app_typetransfert', methods: ['GET'])]
    public function getAllTypeTransfert(TypeTransfertRepository $typeTransfertRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesTypeTransfert = $typeTransfertRepository->findAll();

        $jsonLesTypeTransfert = $serializer->serialize($lesTypeTransfert, "json",  ['groups' => 'getAllTypeTransfert']);

        return new JsonResponse($jsonLesTypeTransfert, Response::HTTP_OK, [], true);
    }
}


