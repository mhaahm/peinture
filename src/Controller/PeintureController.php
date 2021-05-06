<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Services\CommentService;
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
        $peintures = $peintureRepository->findBy([],['id' => 'DESC']);
        return $this->render('peinture/realisation.html.twig', [
            'peintures' => $paginator->paginate($peintures,$request->query->getInt('page',1),self::NB_PER_PAGE),

        ]);
    }

    /**
     * @Route("/realisations/{slug}",name="detail_realisation")
     */
    public function details(Peinture $peinture, Request $request,
    CommentService $commentService,
    CommentaireRepository $commentaireRepository)
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commentService->saveComment($commentaire,null,$peinture);
            $this->redirectToRoute('detail_realisation',[
                'slug' => $peinture->getSlug()
            ]);
        }
        $commentaires = $commentaireRepository->findCommentaires($peinture);
        return $this->render("peinture/detail.html.twig",[
            'peinture' => $peinture,
            'commentaires' => $commentaires,
            'form' => $form->createView()
        ]);
    }
}
