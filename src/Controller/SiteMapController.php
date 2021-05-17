<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\CategorieRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteMapController extends AbstractController
{
    /**
    * @Route("/sitemap.xml", name="site_map", defaults= {"_format":"xml"})
    */
    public function index(Request $request,
    PeintureRepository $peintureRepository,
    BlogPostRepository $blogPostRepository,
    CategorieRepository $categorieRepository): Response
    {
        $hostname = $request->getSchemeAndHttpHost();
        $urls = [];
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('realisation')];
        $urls[] = ['loc' => $this->generateUrl('portfolio')];
        $urls[] = ['loc' => $this->generateUrl('actualite')];
        $urls[] = ['loc' => $this->generateUrl('contacte')];
        $urls[] = ['loc' => $this->generateUrl('a_propos')];
        foreach($peintureRepository->findAll() as $peinture)
        {
            $urls[] = [
                'loc' => $this->generateUrl('detail_realisation',['slug' => $peinture->getSlug()]),
                'lastmod' => $peinture->getDateRealisation()->format('Y-m-d')
            ];
        }

        foreach($blogPostRepository->findAll() as $blogpost)
        {
            $urls[] = [
                'loc' => $this->generateUrl('blog_post',['slug' => $blogpost->getSlug()]),
                'lastmod' => $blogpost->getCreatedAt()->format('Y-m-d')
            ];
        }
       
        $response = new Response($this->renderView("site_map/index.html.twig",
        [
            'urls' => $urls,
            'hostname' => $hostname
        ],200));
        $response->headers->set('content-type','text/xml');
        return $response;
    }
}
