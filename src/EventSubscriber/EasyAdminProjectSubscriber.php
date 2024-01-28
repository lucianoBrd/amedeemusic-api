<?php

namespace App\EventSubscriber;

use Exception;
use App\Entity\Project;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class EasyAdminProjectSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private ContainerBagInterface $params, 
        private Filesystem $filesystem,
        private SluggerInterface $slugger,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityDeletedEvent::class => ['deleteImageOnDelete'],
            BeforeEntityPersistedEvent::class => ['setProjectSlug'],
        ];
    }

    public function deleteImageOnDelete(AfterEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Project)) {
            return;
        }

        $image = $entity->getImage();
        try {
            $this->filesystem->remove([
                $this->params->get('images_path_directory') . 'project/' . $image
            ]);
        } catch (Exception $exception) {}
    }

    public function setProjectSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Project)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getName());
        $entity->setSlug(strtolower($slug));
    }
}