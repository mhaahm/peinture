<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\BlogPostRepository;
use App\Repository\CommentaireRepository;
use App\Services\CommentService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    /**
     * @Route("/actualite", name="actualite")
     */
    public function index(PaginatorInterface $paginator,
    Request $request,
    BlogPostRepository $blogPostRepository): Response
    {
        $actualites = $blogPostRepository->findAll();
        return $this->render('blog_post/index.html.twig', [
            'blogPosts' => $paginator->paginate($actualites,$request->query->getInt('page',1),6),
        ]);
    }

    /**
     * @Route("/blogPost/{slug}", name="blog_post")
     */
    public function actualiteDetail(
        BlogPost $blogPost,
        Request $request,
        CommentService $commentService,
        CommentaireRepository $commentaireRepository
    )
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commentService->saveComment($commentaire,$blogPost);
            $this->redirectToRoute('blog_post',[
                'slug' => $blogPost->getSlug()
            ]);
        }
        $commentaires = $commentaireRepository->findCommentaires($blogPost);
        return $this->render('blog_post/detail.html.twig', [
            'blogPost' => $blogPost,
            'form'=> $form->createView(),
            'commentaires' => $commentaires
        ]);
    }
}
