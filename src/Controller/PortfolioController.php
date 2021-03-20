<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\CategorieRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(CategorieRepository $categorieRepository, PeintureRepository $peintureRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'categories' => $categorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/peinture/{slug}", name="peinture_detail")
     */
    public function peintureDetail(Peinture $peinture)
    {
        return $this->render('portfolio/peinturedetail.html.twig',[
            'peinture' => $peinture
        ]);
    }
}
