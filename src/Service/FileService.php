<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class FileService
{
    public function __construct(
        private ContainerBagInterface $params,
    )
    {
    }

    public function getExtension(string $fileName): string {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    public function getType(string $fileName): string {
        $mimeType = $this->getMimeType($fileName);
        return (explode('/', $mimeType)[0]);
    }

    public function getMimeType(string $fileName): string {
        return mime_content_type($this->params->get('images_path_directory') . 'gallery/' . $fileName);
    }
}
