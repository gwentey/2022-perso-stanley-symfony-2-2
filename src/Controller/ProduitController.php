<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\FamilleProduitRepository;
use App\Repository\ProduitRepository;
use App\Repository\UniteeProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ProduitController extends AbstractController
{
    #[Route('/api/produit', name: 'getAllProduit', methods: ['GET'])]
    public function getAllProduit(
        ProduitRepository $produitRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $lesProduits = $produitRepository->findAll();

        $jsonLesProduits = $serializer->serialize($lesProduits, "json",  ['groups' => 'getAllProduit']);

        return new JsonResponse($jsonLesProduits, Response::HTTP_OK, [], true);
    }

    #[Route('/api/produit/{id}', name: 'detailProduit', methods: ['GET'])]
    public function getDetailProduit(int $id, ProduitRepository $produitRepository, SerializerInterface $serializer): JsonResponse
    {
        $produit = $produitRepository->find($id);

        $jsonProduit = $serializer->serialize($produit, 'json', ['groups' => 'getAllProduit']);
        return new JsonResponse($jsonProduit, Response::HTTP_OK, [], true);
    }

    #[Route('/api/produit', name: "creeProduit", methods: ['POST'])]
    public function creeProduit(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        FamilleProduitRepository $familleProduitRepository,
        UniteeProduitRepository $uniteeProduitRepository,
        UrlGeneratorInterface $urlGenerator
    ): JsonResponse {

        $produit = $serializer->deserialize($request->getContent(), Produit::class, 'json');

        $content = $request->toArray();
        $idFamille = $content['idFamille'] ?? -1;
        $idUnitee = $content['idUnitee'] ?? -1;

        $produit->setFamille($familleProduitRepository->find($idFamille));
        $produit->setUnitee($uniteeProduitRepository->find($idUnitee));

        $em->persist($produit);
        $em->flush();

        $jsonProduit = $serializer->serialize($produit, 'json', ['groups' => 'getAllProduit']);

        $location = $urlGenerator->generate('detailProduit', ['id' => $produit->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonProduit, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    #[Route('/api/produit/{idCurrentProduit}', name: "updateProduit", methods: ['PUT'])]
    public function updateProduit(
        Request $request,
        SerializerInterface $serializer,
        int $idCurrentProduit,
        ProduitRepository $produitRepository,
        EntityManagerInterface $em,
        FamilleProduitRepository $familleProduitRepository,
        UniteeProduitRepository $uniteeProduitRepository
    ): JsonResponse {

        $currentProduit = $produitRepository->find($idCurrentProduit);
        $updatedProduit = $serializer->deserialize(
            $request->getContent(),
            Produit::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentProduit]
        );

        $content = $request->toArray();
        $idFamille = $content['idFamille'] ?? -1;
        $idUnitee = $content['idUnitee'] ?? -1;

        if ($idFamille != -1) {
            $updatedProduit->setFamille($familleProduitRepository->find($idFamille));
        }
        if ($idUnitee != -1) {
            $updatedProduit->setUnitee($uniteeProduitRepository->find($idUnitee));
        }
        
        $em->persist($updatedProduit);
        $em->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
