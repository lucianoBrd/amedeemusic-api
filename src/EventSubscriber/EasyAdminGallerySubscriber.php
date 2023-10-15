<?php

namespace App\EventSubscriber;

use Exception;
use App\Entity\Gallery;
use App\Service\FileService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class EasyAdminGallerySubscriber implements EventSubscriberInterface
{

    public function __construct(
        private ContainerBagInterface $params, 
        private Filesystem $filesystem,
        private FileService $fileService,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityDeletedEvent::class => ['deleteImageOnDelete'],
            BeforeEntityPersistedEvent::class => ['setGalleryTypeExt'],
            BeforeEntityUpdatedEvent::class => ['setGalleryTypeExt'],
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

    public function setGalleryTypeExt(BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Gallery)) {
            return;
        }

        $image = $entity->getImage();

        // Set extension
        $entity->setExtension($this->fileService->getExtension($image));

        // Set mime type
        $entity->setMimeType($this->fileService->getMimeType($image));

        // Set type
        $entity->setType($this->fileService->getType($image));
    }
}