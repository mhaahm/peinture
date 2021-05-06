<?php
namespace App\Services;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Peinture;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentService {
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
    public function saveComment(
        Commentaire $comment,
        ?BlogPost $blogPost = null,
        ?Peinture $peinture = null):void
    {
        try {
            $comment->setIsPublished(false);
            $comment->setCreatedAt(new \DateTime());
            $comment->setBlogpost($blogPost);
            $comment->setPeinture($peinture);
            $this->em->persist($comment);
            $this->em->flush();
            $this->flashBag->add('success','Votre commentaire est bien enregistré avec success');
        } catch (\Exception $e) {
            $this->flashBag->add('error','Erreur d\'enregistrement du commentaire');
        }

    }
}
