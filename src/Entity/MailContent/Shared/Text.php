<?php

namespace App\Entity\MailContent\Shared;

use App\Entity\MailContent\MailContent;
use App\Repository\MailContent\Shared\TextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextRepository::class)]
class Text
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $paragraph = null;

    #[ORM\ManyToOne]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'texts')]
    private ?MailContent $mailContent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(?string $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMailContent(): ?MailContent
    {
        return $this->mailContent;
    }

    public function setMailContent(?MailContent $mailContent): self
    {
        $this->mailContent = $mailContent;

        return $this;
    }
}
