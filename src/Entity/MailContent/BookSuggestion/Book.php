<?php

namespace App\Entity\MailContent\BookSuggestion;

use App\Entity\MailContent\BookSuggestion;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\Shared\Image;
use App\Repository\MailContent\BookSuggestion\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Button $button = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'books', cascade: ['persist'])]
    private ?BookSuggestion $bookSuggestion = null;

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

    public function getButton(): ?Button
    {
        return $this->button;
    }

    public function setButton(?Button $button): self
    {
        $this->button = $button;

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

    public function getBookSuggestion(): ?BookSuggestion
    {
        return $this->bookSuggestion;
    }

    public function setBookSuggestion(?BookSuggestion $bookSuggestion): self
    {
        $this->bookSuggestion = $bookSuggestion;

        return $this;
    }
}
