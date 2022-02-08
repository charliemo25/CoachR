<?php

namespace App\Controller;

use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class SeanceController extends AbstractController
{
    public function __construct(
        private SeanceRepository $seanceRepository
    ) {}

    #[Route('/seances', name:'get_seances', methods:['GET'])]
    public function getSeances(): Response
    {
        return $this->json($this->seanceRepository->findAll(), 200, [], ['groups' => 'show_seance']);
    }
}