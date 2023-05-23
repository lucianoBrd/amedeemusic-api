<?php

namespace App\Entity\MailContent\Shared;


class Button
{
    private ?string $id = null;
    private ?string $name = null;
    private ?string $link = null;
    private ?string $color = null;

    public function __construct()
    {
        $this->id = uniqid();
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
	public function getName(): ?string {
		return $this->name;
	}
	
	/**
	 * @param  $name 
	 * @return self
	 */
	public function setName(?string $name): self {
		$this->name = $name;
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
}
