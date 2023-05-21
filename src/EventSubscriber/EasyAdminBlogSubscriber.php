<?php

namespace App\EventSubscriber;

use Exception;
use App\Entity\Blog;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class EasyAdminBlogSubscriber implements EventSubscriberInterface
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
            BeforeEntityPersistedEvent::class => ['setBlogSlug'],
        ];
    }

    public function deleteImageOnDelete(AfterEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Blog)) {
            return;
        }

        $image = $entity->getImage();
        try {
            $this->filesystem->remove([
                $this->params->get('images_path_directory') . 'blog/' . $image
            ]);
        } catch (Exception $exception) {}
    }

    public function setBlogSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Blog)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle());
        $entity->setSlug(strtolower($slug . '-' . time()));
    }
}