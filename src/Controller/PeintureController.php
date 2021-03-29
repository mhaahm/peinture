<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeintureController extends AbstractController
{
    const NB_PER_PAGE = 6;
    /**
     * @Route("/realisation", name="realisation")
     */
    public function index(PeintureRepository $peintureRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $peintures = $peintureRepository->findAll();
        return $this->render('peinture/realisation.html.twig', [
            'peintures' => $paginator->paginate($peintures,$request->query->getInt('page',1),self::NB_PER_PAGE),

        ]);
    }

    /**
     * @Route("/realisations/{slug}",name="detail_realisation")
     */
    public function details(Peinture $peinture)
    {
        return $this->render("peinture/detail.html.twig",[
            'peinture' => $peinture
        ]);
    }
}
