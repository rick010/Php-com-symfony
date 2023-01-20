<?php

namespace App\Controller;

use App\Entity\Agencia;
use App\Form\Agencia1Type;
use App\Repository\AgenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function index(AgenciaRepository $agenciaRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'agencias' => $agenciaRepository->findAll(),
        ]);
    }

    

}