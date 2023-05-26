<?php

namespace App\Entity\MailContent\EventPlan;

use App\Entity\MailContent\EventPlan;
use App\Entity\MailContent\Shared\Image;
use App\Repository\MailContent\EventPlan\SpeakerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpeakerRepository::class)]
class Speaker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $paragraph = null;

    #[ORM\ManyToOne]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'speakers')]
    private ?EventPlan $eventPlan = null;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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

    public function getEventPlan(): ?EventPlan
    {
        return $this->eventPlan;
    }

    public function setEventPlan(?EventPlan $eventPlan): self
    {
        $this->eventPlan = $eventPlan;

        return $this;
    }
}
