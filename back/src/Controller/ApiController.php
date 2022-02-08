<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api')]
class ApiController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository,
        private RequestStack $requestStack,
        private SerializerInterface $serializer
    ) 
    {}

    #[Route('/users', name:'create_user', methods:['POST'])]
    public function createUser(): Response
    {
        $request = $this->requestStack->getCurrentRequest();

        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $errors = $validator->validate();

        return $this->json("L'utilisateur à été créer", 201);
    }
}
