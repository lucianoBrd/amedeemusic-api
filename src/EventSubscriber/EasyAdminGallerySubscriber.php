<?php

namespace App\EventSubscriber;

use Exception;
use App\Entity\Gallery;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class EasyAdminGallerySubscriber implements EventSubscriberInterface
{

    public function __construct(
        private ContainerBagInterface $params, 
        private Filesystem $filesystem,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityDeletedEvent::class => ['deleteImageOnDelete'],
        ];
    }

    public function deleteImageOnDelete(AfterEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Gallery)) {
            return;
        }

        $image = $entity->getImage();
        try {
            $this->filesystem->remove([
                $this->params->get('images_path_directory') . 'gallery/' . $image
            ]);
        } catch (Exception $exception) {}
    }
}