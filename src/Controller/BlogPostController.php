<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
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
    public function index(PaginatorInterface $paginator,Request $request,BlogPostRepository $blogPostRepository): Response
    {
        $actualites = $blogPostRepository->findAll();
        return $this->render('blog_post/index.html.twig', [
            'blogPosts' => $paginator->paginate($actualites,$request->query->getInt('page',1),6),
        ]);
    }
}
