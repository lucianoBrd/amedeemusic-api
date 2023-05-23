<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\MailContentInterface;

abstract class MailContent implements MailContentInterface
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $titleBold = null;
    public ?string $color = null;
	public array $texts = [];

    public function __construct()
    {
        $this->id = uniqid();
        $this->texts = [];
        $this->color = '292929';
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
	public function getTitleBold(): ?string {
		return $this->titleBold;
	}
	
	/**
	 * @param  $titleBold 
	 * @return self
	 */
	public function setTitleBold(?string $titleBold): self {
		$this->titleBold = $titleBold;
		return $this;
	}

	/**
     * @return array<Text>
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    public function addText(Text $text): self
    {
        if (!array_key_exists($text->getId(), $this->texts)) {
            $this->texts[$text->getId()] = $text;
        }

        return $this;
    }

    public function removeText(Text $text): self
    {
        if (array_key_exists($text->getId(), $this->texts)) {
            unset($this->texts[$text->getId()]);
        }

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
	public function setColor(string $color): self {
		$this->color = $color;
		return $this;
	}
}
