<?php

namespace App\Entity\MailContent\BlogArticles;

use App\Entity\MailContent\Shared\Image;

class Article
{
    private ?string $id = null;
    private ?string $category = null;
    private ?string $color = null;
    private ?string $title = null;
    private ?string $link = null;
    private ?string $paragraph = null;
    private ?string $paragraphBold = null;
    private ?Image $image = null;

    public function __construct()
    {
        $this->id = uniqid();
    }

	/**
	 * @return 
	 */
	public function getCategory(): ?string {
		return $this->category;
	}
	
	/**
	 * @param  $category 
	 * @return self
	 */
	public function setCategory(?string $category): self {
		$this->category = $category;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getColor(): ?string {
		return $this->color;
	}
	
	/**
	 * @param  $color 
	 * @return self
	 */
	public function setColor(?string $color): self {
		$this->color = $color;
		return $this;
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
	public function getLink(): ?string {
		return $this->link;
	}
	
	/**
	 * @param  $link 
	 * @return self
	 */
	public function setLink(?string $link): self {
		$this->link = $link;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getParagraph(): ?string {
		return $this->paragraph;
	}
	
	/**
	 * @param  $paragraph 
	 * @return self
	 */
	public function setParagraph(?string $paragraph): self {
		$this->paragraph = $paragraph;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getParagraphBold(): ?string {
		return $this->paragraphBold;
	}
	
	/**
	 * @param  $paragraphBold 
	 * @return self
	 */
	public function setParagraphBold(?string $paragraphBold): self {
		$this->paragraphBold = $paragraphBold;
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
}
