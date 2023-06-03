<?php

namespace App\Entity\MailContent\Shared;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

use App\Repository\MailContent\Shared\ImageRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\File(mimeTypes: ["image/png", "image/jpeg", "image/jpg" ])]
    private string|UploadedFile|File|null $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $absolutePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): string|UploadedFile|File|null
    {
        return $this->image;
    }

    public function setImage(string|UploadedFile|File|null $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAbsolutePath(): ?string
    {
        return $this->absolutePath;
    }

    public function setAbsolutePath(?string $absolutePath): self
    {
        $this->absolutePath = $absolutePath;

        return $this;
    }
}
