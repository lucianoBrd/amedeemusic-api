<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\BookSuggestion\Book;
use App\Entity\MailContent\BookSuggestion\Color;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\BookSuggestionRepository;

#[ORM\Entity(repositoryClass: BookSuggestionRepository::class)]
class BookSuggestion extends MailContent implements MailContentInterface
{
    #[ORM\OneToMany(mappedBy: 'bookSuggestion', targetEntity: Book::class, cascade: ['persist', 'remove'])]
    private Collection $books;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featuredTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featuredAuthor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $featuredCategory = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Button $featuredButton = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Image $featuredImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sectionFeaturedTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sectionBestTitle = null;

    public function __construct()
    {
        parent::__construct();
        $this->books = new ArrayCollection();
        $this->color = Color::COLOR;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setBookSuggestion($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getBookSuggestion() === $this) {
                $book->setBookSuggestion(null);
            }
        }

        return $this;
    }

    public function getFeaturedTitle(): ?string
    {
        return $this->featuredTitle;
    }

    public function setFeaturedTitle(?string $featuredTitle): self
    {
        $this->featuredTitle = $featuredTitle;

        return $this;
    }

    public function getFeaturedAuthor(): ?string
    {
        return $this->featuredAuthor;
    }

    public function setFeaturedAuthor(?string $featuredAuthor): self
    {
        $this->featuredAuthor = $featuredAuthor;

        return $this;
    }

    public function getFeaturedCategory(): ?string
    {
        return $this->featuredCategory;
    }

    public function setFeaturedCategory(?string $featuredCategory): self
    {
        $this->featuredCategory = $featuredCategory;

        return $this;
    }

    public function getFeaturedButton(): ?Button
    {
        return $this->featuredButton;
    }

    public function setFeaturedButton(?Button $featuredButton): self
    {
        $this->featuredButton = $featuredButton;

        return $this;
    }

    public function getFeaturedImage(): ?Image
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?Image $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getSectionFeaturedTitle(): ?string
    {
        return $this->sectionFeaturedTitle;
    }

    public function setSectionFeaturedTitle(?string $sectionFeaturedTitle): self
    {
        $this->sectionFeaturedTitle = $sectionFeaturedTitle;

        return $this;
    }

    public function getSectionBestTitle(): ?string
    {
        return $this->sectionBestTitle;
    }

    public function setSectionBestTitle(?string $sectionBestTitle): self
    {
        $this->sectionBestTitle = $sectionBestTitle;

        return $this;
    }
}
