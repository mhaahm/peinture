<?php

namespace App\Controller;

use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PeintureRepository $peintureRepository): Response
    {
        $peintures = $peintureRepository->getLastPeinture(3);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peintures' =>$peintures
        ]);
    }
}
