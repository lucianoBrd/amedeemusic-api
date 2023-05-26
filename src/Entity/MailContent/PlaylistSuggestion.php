<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\MailContentInterface;
use App\Entity\MailContent\PlaylistSuggestion\Color;
use App\Repository\MailContent\PlaylistSuggestionRepository;

#[ORM\Entity(repositoryClass: PlaylistSuggestionRepository::class)]
class PlaylistSuggestion extends MailContent implements MailContentInterface
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $playlistTitle = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $playlistParagraph = null;

    #[ORM\ManyToOne]
    private ?Button $playlistButton = null;

    #[ORM\ManyToOne]
    private ?Image $playlistImage = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistTitle(): ?string
    {
        return $this->playlistTitle;
    }

    public function setPlaylistTitle(?string $playlistTitle): self
    {
        $this->playlistTitle = $playlistTitle;

        return $this;
    }

    public function getPlaylistParagraph(): ?string
    {
        return $this->playlistParagraph;
    }

    public function setPlaylistParagraph(?string $playlistParagraph): self
    {
        $this->playlistParagraph = $playlistParagraph;

        return $this;
    }

    public function getPlaylistButton(): ?Button
    {
        return $this->playlistButton;
    }

    public function setPlaylistButton(?Button $playlistButton): self
    {
        $this->playlistButton = $playlistButton;

        return $this;
    }

    public function getPlaylistImage(): ?Image
    {
        return $this->playlistImage;
    }

    public function setPlaylistImage(?Image $playlistImage): self
    {
        $this->playlistImage = $playlistImage;

        return $this;
    }
}
