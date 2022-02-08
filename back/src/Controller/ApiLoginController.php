<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $request = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy([
            "email" => $request["username"],
            "password" => $request["password"]
        ]);
        if(!$user){
            return $this->json("Les identifiants sont invalides.",401);
        }
        return $this->json("L'utilisateur est bien connecter.", 200);
    }
}
