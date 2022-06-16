<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AtelierController extends AbstractController
{
    #[Route('/api/atelier', name: 'getAllAtelier', methods: ['GET'])]
    public function getAllAtelier(AtelierRepository $atelierRepository, 
    SerializerInterface $serializer): JsonResponse
    {
        $lesAteliers = $atelierRepository->findAll();

        $jsonLesAteliers = $serializer->serialize($lesAteliers, "json", ['groups' => 'getAllAtelier']);

        return new JsonResponse($jsonLesAteliers, Response::HTTP_OK, [], true);
    }

    #[Route('/api/atelier/{id}', name: 'detailAtelier', methods: ['GET'])]
    public function getDetailAtelier(int $id, AtelierRepository $atelierRepository, SerializerInterface $serializer): JsonResponse 
    {
        $atelier = $atelierRepository->find($id);

        $jsonAtelier = $serializer->serialize($atelier, 'json', ['groups' => 'getAllAtelier']);
        return new JsonResponse($jsonAtelier, Response::HTTP_OK, [], true);
    }

    #[Route('/api/atelier/{id}', name: 'deleteAtelier', methods: ['DELETE'])]
    public function deleteAtelier(int $id, AtelierRepository $atelierRepository, EntityManagerInterface $em): JsonResponse 
    {
        $atelier = $atelierRepository->find($id);
        $em->remove($atelier);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
    
    #[Route('/api/atelier', name:"creeAtelier", methods: ['POST'])]
    public function creeAtelier(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse 
    {

        $atelier = $serializer->deserialize($request->getContent(), Atelier::class, 'json');
        $em->persist($atelier);
        $em->flush();

        $jsonAtelier = $serializer->serialize($atelier, 'json', ['groups' => 'getAllAtelier']);
        
        $location = $urlGenerator->generate('detailAtelier', ['id' => $atelier->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonAtelier, Response::HTTP_CREATED, ["Location" => $location], true);
   }

    
}
