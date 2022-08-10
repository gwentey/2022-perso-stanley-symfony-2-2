<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class PasswordChangerController extends AbstractController
{
    public function __construct(private Security $security, private UserRepository $userRepository, 
    private EntityManagerInterface $em, private UserPasswordHasherInterface $passwordHasher){}

    public function __invoke(Request $request)
    {
        $userCurrent = $this->security->getUser();

        $content = $request->toArray();
        $password = $content['password'] ?? -1;

        $user = $this->userRepository->findOneBy(['username' => $userCurrent->getUserIdentifier()]);

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );


        $user->setPassword($hashedPassword);
        $this->em->persist($user);
        $this->em->flush();


        return $userCurrent;
    }

}
