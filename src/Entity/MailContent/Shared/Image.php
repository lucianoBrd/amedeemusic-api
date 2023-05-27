<?php

namespace App\Entity\MailContent\Shared;

use App\Repository\MailContent\Shared\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $absolutePath = null;

    public function __construct()
    {
		$this->absolutePath = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isAbsolutePath(): ?bool
    {
        return $this->absolutePath;
    }

    public function setAbsolutePath(bool $absolutePath): self
    {
        $this->absolutePath = $absolutePath;

        return $this;
    }
}
