<?php 

namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Service\FileUploaderService;
use App\Entity\MailContent\Shared\Image;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class ImageUploadListener implements EventSubscriberInterface
{
    public function __construct(
        private FileUploaderService $fileUploaderService,
    )
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preRemove,
            Events::preUpdate,
        ];
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->uploadFile('persist', $args->getObject());
    }

    public function preRemove(PreRemoveEventArgs $args): void
    {
        $this->uploadFile('remove', $args->getObject());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->uploadFile('update', $args->getObject(), $args->getEntityChangeSet());
    }

    private function uploadFile(string $action, mixed $entity, array $changeSet = []): void
    {
        if (!$entity instanceof Image) {
            return;
        }

        $entity = $this->fileUploaderService->upload($action, $entity, $changeSet);
    }
}