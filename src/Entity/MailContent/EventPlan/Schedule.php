<?php

namespace App\Entity\MailContent\EventPlan;

class Schedule
{
    private ?string $id = null;
    private ?string $color = null;
    private ?string $hour = null;
    private array $paragraphs = [];

    public function __construct()
    {
        $this->id = uniqid();
		$this->paragraphs = [];
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
	public function getHour(): ?string {
		return $this->hour;
	}
	
	/**
	 * @param  $hour 
	 * @return self
	 */
	public function setHour(?string $hour): self {
		$this->hour = $hour;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getParagraphs(): array {
		return $this->paragraphs;
	}
	
	public function addParagraph(string $paragraph): self
    {
    	$this->paragraphs[] = $paragraph;

        return $this;
    }

    public function removeParagraph(string $paragraph): self
    {
        $this->paragraphs = array_diff($this->paragraphs, [$paragraph]);

        return $this;
    }
}
