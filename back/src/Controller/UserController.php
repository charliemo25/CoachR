<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\EditServices;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api')]
class UserController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository,
        private RequestStack $requestStack,        
        private EditServices $editServices
    ) 
    {}

    #[Route('/users/{id<\d+>}', name:'get_user', methods:['GET'])]
    public function getUserById(int $id): Response
    {
        return $this->json($this->userRepository->find($id), 200);
    }

    #[Route('/users', name:'get_users', methods:['GET'])]
    public function getUsers(): Response
    {
        return $this->json($this->userRepository->findAll(), 200, [], ["groups" => "show_user"]);
    }

    #[Route('/users', name:'create_user', methods:['POST'])]
    public function createUser(ValidatorInterface $validator, SerializerInterface $serialize): Response
    {
        try {
            $request = $this->requestStack->getCurrentRequest();

            $user = $serialize->deserialize($request->getContent(), User::class, 'json');
            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $this->em->persist($user);
            $this->em->flush();

            return $this->json(["message" => "L'utilisateur à été créé", "User" => $user], 200);
        } catch (\Throwable $th) {

            return $this->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], 400);

        }
    }

    #[Route('/users/{id<\d+>}', name:'edit_user', methods:['PUT'])]
    public function editUser($id, ValidatorInterface $validator, SerializerInterface $serialize): Response
    {
        
        try {
            $request = $this->requestStack->getCurrentRequest();

            $userJson = $serialize->serializer->deserialize($request, User::class, 'json');
            $errors = $validator->validate($userJson);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $user = $this->userRepository->find($id);
            $result = $this->editServices->edit($user, $userJson);

            return $this->json(['User' => $result], 200, [], []);

        } catch (\Throwable $th) {

            return $this->json([
                'status' => 400,
                'message' => $th->getMessage()
            ], 400);

        }
    }

}
