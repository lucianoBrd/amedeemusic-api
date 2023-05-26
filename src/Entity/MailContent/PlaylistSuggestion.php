<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\PlaylistSuggestion\Color;
use App\Entity\MailContent\MailContentInterface;

class PlaylistSuggestion extends MailContent implements MailContentInterface
{
    private ?string $playlistTitle = null;
    private ?string $playlistParagraph = null;
    private ?Button $playlistButton = null;
    private ?Image $playlistImage = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

	/**
	 * @return 
	 */
	public function getPlaylistTitle(): ?string {
		return $this->playlistTitle;
	}
	
	/**
	 * @param  $playlistTitle 
	 * @return self
	 */
	public function setPlaylistTitle(?string $playlistTitle): self {
		$this->playlistTitle = $playlistTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getPlaylistParagraph(): ?string {
		return $this->playlistParagraph;
	}
	
	/**
	 * @param  $playlistParagraph 
	 * @return self
	 */
	public function setPlaylistParagraph(?string $playlistParagraph): self {
		$this->playlistParagraph = $playlistParagraph;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getPlaylistButton(): ?Button {
		return $this->playlistButton;
	}
	
	/**
	 * @param  $playlistButton 
	 * @return self
	 */
	public function setPlaylistButton(?Button $playlistButton): self {
		$this->playlistButton = $playlistButton;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getPlaylistImage(): ?Image {
		return $this->playlistImage;
	}
	
	/**
	 * @param  $playlistImage 
	 * @return self
	 */
	public function setPlaylistImage(?Image $playlistImage): self {
		$this->playlistImage = $playlistImage;
		return $this;
	}
}
