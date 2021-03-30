<?php
namespace App\services;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ContactService {
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ContactService constructor.
     * @param EntityManagerInterface $em
     * @param FlashBagInterface $flashBag
     */
    public function __construct(EntityManagerInterface $em, FlashBagInterface $flashBag)
    {
        $this->em = $em;
        $this->flashBag = $flashBag;
    }

    /**
     * @param Contact $contact
     */
    public function saveContact(Contact $contact):void
    {
        try {
            $contact->setIsSent(false);
            $contact->setCreatedAt(new \DateTime());
            $this->em->persist($contact);
            $this->em->flush();
            $this->flashBag->add('success','Votre message est bien envoyé avec success');
        } catch (\Exception $e) {
            $this->flashBag->add('error','Erreur d\'envoi du message');
        }

    }

    /**
     * @param Contact $contact
     * @throws Exception
     */
    public function setSendedContact(Contact $contact)
    {
        try{
            $contact->setIsSent(true);
            $this->em->persist($contact);
            $this->em->flush();
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
