<?php
namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
          BeforeEntityPersistedEvent::class => 'setDateAndUser'
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {

        $entity = $event->getEntityInstance();

        if(!($entity instanceof BlogPost) && !($entity instanceof Peinture)){
            return;
        }
        $entity->setCreatedAt(new \DateTime());
        $user = $this->security->getUser();
        $entity->setUser($user);
    }
}
