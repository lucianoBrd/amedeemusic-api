<?php

namespace App\Entity\MailContent\MonthStats;

use App\Entity\MailContent\Shared\Image;

class Stat
{
    private ?string $id = null;
    private ?string $number = null;
    private ?string $title = null;
    private ?string $subTitle = null;
    private ?string $paragraph = null;
    private ?string $evolution = null;
    private ?string $date = null;
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
	public function getNumber(): ?string {
		return $this->number;
	}
	
	/**
	 * @param  $number 
	 * @return self
	 */
	public function setNumber(?string $number): self {
		$this->number = $number;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSubTitle(): ?string {
		return $this->subTitle;
	}
	
	/**
	 * @param  $subTitle 
	 * @return self
	 */
	public function setSubTitle(?string $subTitle): self {
		$this->subTitle = $subTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getEvolution(): ?string {
		return $this->evolution;
	}
	
	/**
	 * @param  $evolution 
	 * @return self
	 */
	public function setEvolution(?string $evolution): self {
		$this->evolution = $evolution;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getDate(): ?string {
		return $this->date;
	}
	
	/**
	 * @param  $date 
	 * @return self
	 */
	public function setDate(?string $date): self {
		$this->date = $date;
		return $this;
	}
}
