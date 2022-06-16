<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProduitController extends AbstractController
{
    #[Route('/api/produit', name: 'app_produit')]
    public function getAllProduit(ProduitRepository $produitRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesProduits = $produitRepository->findAll();

        $jsonLesProduits = $serializer->serialize($lesProduits, "json");

        return new JsonResponse($jsonLesProduits, Response::HTTP_OK, [], true);
    }
}
