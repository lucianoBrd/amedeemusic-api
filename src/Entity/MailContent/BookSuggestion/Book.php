<?php

namespace App\Entity\MailContent\BookSuggestion;

use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\BookSuggestion\Color;

class Book
{
    private ?string $id = null;
    private ?string $title = null;
    private ?Button $button = null;
    private ?Image $image = null;

    public function __construct()
    {
        $this->id = uniqid();
    }

	/**
	 * @return 
	 */
	public function getTitle(): ?string {
		return $this->title;
	}
	
	/**
	 * @param  $title 
	 * @return self
	 */
	public function setTitle(?string $title): self {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getId(): ?string {
		return $this->id;
	}

	/**
	 * @return 
	 */
	public function getImage(): ?Image {
		return $this->image;
	}
	
	/**
	 * @param  $image 
	 * @return self
	 */
	public function setImage(?Image $image): self {
		$this->image = $image;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getButton(): ?Button {
		return $this->button;
	}
	
	/**
	 * @param  $button 
	 * @return self
	 */
	public function setButton(?Button $button): self {
		$this->button = $button;
		return $this;
	}
}
