<?php

namespace App\Entity\MailContent\FreeGoods;

use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\FreeGoods\Color;

class Good
{
    private ?string $id = null;
    private ?string $color = null;
    private ?string $title = null;
    private ?string $link = null;
    private ?string $author = null;
    private ?Image $image = null;

    public function __construct()
    {
        $this->id = uniqid();
        $this->color = Color::COLOR;
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
	public function getAuthor(): ?string {
		return $this->author;
	}
	
	/**
	 * @param  $author 
	 * @return self
	 */
	public function setAuthor(?string $author): self {
		$this->author = $author;
		return $this;
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
