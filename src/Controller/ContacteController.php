<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\services\ContactService;

class ContacteController extends AbstractController
{

    /**
     * @var ContactService
     */
    private $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/contacte", name="contacte")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class,$contact);
        $formContact->handleRequest($request);
        if($formContact->isSubmitted() && $formContact->isValid()) {
            $contact = $formContact->getData();
            $this->service->saveContact($contact);
            return $this->redirectToRoute('contacte');
        }
        return $this->render('contacte/index.html.twig', [
            'formContact' => $formContact->createView(),
        ]);

    }
}
