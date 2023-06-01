<?php

namespace App\Service;

use Exception;
use App\Entity\Data;
use App\Entity\MailContent\Shared\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class FileUploaderService
{
    public function __construct(
        private ContainerBagInterface $params,
        private EntityManagerInterface $manager,
        private Filesystem $filesystem,
    )
    {
    }

    public function upload(string $action, Image $image, array $changeSet = []): Image {
        $file = $image->getImage();
        if ($file instanceof UploadedFile) {
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $filename = md5(uniqid()) . '.' . $extension;
            $file->move($this->params->get('images_email_path_directory') . 'uploads/', $filename);

            $image->setImage('uploads/' . $filename);
        } else if ($file instanceof File) {
            $filename = $file->getFilename();
            if (!in_array($filename, Data::MAIL_IMAGES)) {
                $image->setImage('uploads/' . $filename);
            } else {
                $image->setImage($filename);
            }
        }

        $imageToRemove = null;

        if ($action == 'remove' && $image && $image->getImage()) {
            $imageToRemove = $image->getImage();
        }
        if ($action == 'update' && !$file instanceof File && array_key_exists('image', $changeSet) && count($changeSet['image']) > 0 && $changeSet['image'][0] !== null) {
            $imageToRemove = $changeSet['image'][0];
        }

        if ($imageToRemove && !in_array($imageToRemove, Data::MAIL_IMAGES)) {
            try {
                $this->filesystem->remove([
                    $this->params->get('images_email_path_directory') . $imageToRemove
                ]);
            } catch (Exception $exception) {}
        }
        return $image;
    }
}
