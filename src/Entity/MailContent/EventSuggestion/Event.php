<?php

namespace App\Entity\MailContent\EventSuggestion;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\EventSuggestion;
use App\Entity\MailContent\EventSuggestion\Color;
use App\Repository\MailContent\EventSuggestion\EventRepository;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: "mail_event")]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $place = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $paragraph = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paragraphBold = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Button $button = null;

    #[ORM\ManyToOne(inversedBy: 'events', cascade: ['persist'])]
    private ?EventSuggestion $eventSuggestion = null;

    public function __construct()
    {
        $this->color = Color::COLORS[array_rand(Color::COLORS)];
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

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

    public function getParagraphBold(): ?string
    {
        return $this->paragraphBold;
    }

    public function setParagraphBold(?string $paragraphBold): self
    {
        $this->paragraphBold = $paragraphBold;

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

    public function getButton(): ?Button
    {
        return $this->button;
    }

    public function setButton(?Button $button): self
    {
        $this->button = $button;

        return $this;
    }

    public function getEventSuggestion(): ?EventSuggestion
    {
        return $this->eventSuggestion;
    }

    public function setEventSuggestion(?EventSuggestion $eventSuggestion): self
    {
        $this->eventSuggestion = $eventSuggestion;

        return $this;
    }
}
