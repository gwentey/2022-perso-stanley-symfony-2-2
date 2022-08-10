<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class MajUser extends AbstractController
{
    public function __construct(private Security $security, private UserRepository $userRepository, 
    private EntityManagerInterface $em, private SerializerInterface $serializer){}



     public function __invoke(Request $request)
    {
        $userCurrent = $this->security->getUser();
        $user = $this->userRepository->findOneBy(['username' => $userCurrent->getUserIdentifier()]);

        $content = $request->toArray();

        $user->setPrenom($content['prenom']);
        $user->setNom($content['nom']);
        $user->setUsername($content['username']);
        $user->setProfile($content['profile']);

        $this->em->persist($user);
        $this->em->flush();


        return $user;
    } 

}
