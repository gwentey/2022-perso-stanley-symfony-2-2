<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Attribute\CurrentUser;


class SecurityController extends AbstractController
{
    #[Route('/apip/security', name: 'security')]
    public function security(#[CurrentUser] ?User $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json($user);
    }

    #[Route('/apip/logout', name: 'logout')]
    public function logout(){}
}
