<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function index(ManagerRegistry $managerRegistry, UserPasswordHasherInterface $passwordHasher): Response
    {

        $entityManager = $managerRegistry->getManager();
        $user = new User();
        
        $plaintextPassword = "admin";
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setUsername("admin");
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('add/index.html.twig', [
            'controller_name' => 'AddController',
        ]);
    }
}
