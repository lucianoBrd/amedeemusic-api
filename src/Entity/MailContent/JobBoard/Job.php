<?php

namespace App\Entity\MailContent\JobBoard;

use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\JobBoard\Info;

class Job
{
    private ?string $id = null;
    private ?string $compagny = null;
    private ?string $title = null;
    private ?string $link = null;
    private ?string $paragraph = null;
    private ?Image $image = null;
	private array $infos = [];

    public function __construct()
    {
        $this->id = uniqid();
		$this->infos = [];
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
	public function getCompagny(): ?string {
		return $this->compagny;
	}
	
	/**
	 * @param  $compagny 
	 * @return self
	 */
	public function setCompagny(?string $compagny): self {
		$this->compagny = $compagny;
		return $this;
	}

	/**
     * @return array<Info>
     */
    public function getInfos(): array
    {
        return $this->infos;
    }

    public function addInfo(Info $info): self
    {
        if (!array_key_exists($info->getId(), $this->infos)) {
            $this->infos[$info->getId()] = $info;
        }

        return $this;
    }

    public function removeInfo(Info $info): self
    {
        if (array_key_exists($info->getId(), $this->infos)) {
            unset($this->infos[$info->getId()]);
        }

        return $this;
    }
}
