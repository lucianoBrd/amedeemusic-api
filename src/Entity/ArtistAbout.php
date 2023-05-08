<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArtistAboutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistAboutRepository::class)]
#[ApiResource]
class ArtistAbout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $about = null;

    #[ORM\ManyToOne(inversedBy: 'artistAbouts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Local $local = null;

    #[ORM\ManyToOne(inversedBy: 'artistAbouts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    public function __toString(): string
    {
        return substr($this->about, 0, 10) . ' - ' . $this->local->__toString();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}