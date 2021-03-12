<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PeintureRepository $peintureRepository,BlogPostRepository $blogPostRepository): Response
    {
        $peintures = $peintureRepository->getLastPeinture(3);
        $blogPosts = $blogPostRepository->getLastBlogPost(3);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peintures' =>$peintures,
            'blogPosts' => $blogPosts
        ]);
    }
}
