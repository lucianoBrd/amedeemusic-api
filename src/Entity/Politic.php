<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PoliticRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoliticRepository::class)]
#[ApiResource]
class Politic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $document = null;

    #[ORM\ManyToOne(inversedBy: 'politics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Local $local = null;

    public function __toString(): string
    {
        return $this->title . ' - ' . $this->local->__toString();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;

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
}
