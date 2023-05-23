<?php

namespace App\Entity\MailContent\Shared;

class Image
{
    private ?string $id = null;
    private ?string $image = null;
    private bool $absolutePath = false;

    public function __construct()
    {
        $this->id = uniqid();
        $this->absolutePath = false;
    }

	/**
	 * @return 
	 */
	public function getImage(): ?string {
		return $this->image;
	}
	
	/**
	 * @param  $image 
	 * @return self
	 */
	public function setImage(?string $image): self {
		$this->image = $image;
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
	public function getAbsolutePath(): bool {
		return $this->absolutePath;
	}
	
	/**
	 * @param  $absolutePath 
	 * @return self
	 */
	public function setAbsolutePath(bool $absolutePath): self {
		$this->absolutePath = $absolutePath;
		return $this;
	}
}
