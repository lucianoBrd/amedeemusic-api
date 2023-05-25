<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\BookSuggestion\Book;
use App\Entity\MailContent\BookSuggestion\Color;
use App\Entity\MailContent\MailContentInterface;

class BookSuggestion extends MailContent implements MailContentInterface
{
    private array $books = [];
    private ?string $featuredTitle = null;
    private ?string $featuredAuthor = null;
    private ?string $featuredCategory = null;
    private ?Button $featuredButton = null;
    private ?Image $featuredImage = null;
    private ?string $sectionFeaturedTitle = null;
    private ?string $sectionBestTitle = null;

    public function __construct()
    {
        $this->books = [];
        $this->color = Color::COLOR;
    }

    /**
     * @return array<Book>
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!array_key_exists($book->getId(), $this->books)) {
            $this->books[$book->getId()] = $book;
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if (array_key_exists($book->getId(), $this->books)) {
            unset($this->books[$book->getId()]);
        }

        return $this;
    }

	/**
	 * @return 
	 */
	public function getFeaturedTitle(): ?string {
		return $this->featuredTitle;
	}
	
	/**
	 * @param  $featuredTitle 
	 * @return self
	 */
	public function setFeaturedTitle(?string $featuredTitle): self {
		$this->featuredTitle = $featuredTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getFeaturedAuthor(): ?string {
		return $this->featuredAuthor;
	}
	
	/**
	 * @param  $featuredAuthor 
	 * @return self
	 */
	public function setFeaturedAuthor(?string $featuredAuthor): self {
		$this->featuredAuthor = $featuredAuthor;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getFeaturedCategory(): ?string {
		return $this->featuredCategory;
	}
	
	/**
	 * @param  $featuredCategory 
	 * @return self
	 */
	public function setFeaturedCategory(?string $featuredCategory): self {
		$this->featuredCategory = $featuredCategory;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getFeaturedButton(): ?Button {
		return $this->featuredButton;
	}
	
	/**
	 * @param  $featuredButton 
	 * @return self
	 */
	public function setFeaturedButton(?Button $featuredButton): self {
		$this->featuredButton = $featuredButton;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getFeaturedImage(): ?Image {
		return $this->featuredImage;
	}
	
	/**
	 * @param  $featuredImage 
	 * @return self
	 */
	public function setFeaturedImage(?Image $featuredImage): self {
		$this->featuredImage = $featuredImage;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSectionFeaturedTitle(): ?string {
		return $this->sectionFeaturedTitle;
	}
	
	/**
	 * @param  $sectionFeaturedTitle 
	 * @return self
	 */
	public function setSectionFeaturedTitle(?string $sectionFeaturedTitle): self {
		$this->sectionFeaturedTitle = $sectionFeaturedTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSectionBestTitle(): ?string {
		return $this->sectionBestTitle;
	}
	
	/**
	 * @param  $sectionBestTitle 
	 * @return self
	 */
	public function setSectionBestTitle(?string $sectionBestTitle): self {
		$this->sectionBestTitle = $sectionBestTitle;
		return $this;
	}
}
