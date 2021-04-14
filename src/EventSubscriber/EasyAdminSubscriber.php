<?php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var Security
     */
    private $security;

    public function __construct(SluggerInterface $slugger,Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
          BeforeEntityPersistedEvent::class => 'setBlogPostSlugAndDate'
        ];
    }

    public function setBlogPostSlugAndDate(BeforeEntityPersistedEvent $event)
    {

        $entity = $event->getEntityInstance();
        if(!($entity instanceof BlogPost)){
            return;
        }
        $slug = $this->slugger->slug($entity->getTitre());
        $entity->setSlug($slug);
        $entity->setCreatedAt(new \DateTime());
        $user = $this->security->getUser();
        $entity->setUser($user);
    }
}
