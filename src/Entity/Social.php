<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SocialRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: SocialRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
    ],
    order: ['id' => 'ASC'],
    paginationEnabled: false
)]
class Social
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    private ?string $fa = null;

    public function __toString(): string
    {
        return $this->link;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getFa(): ?string
    {
        return $this->fa;
    }

    public function setFa(string $fa): self
    {
        $this->fa = $fa;

        return $this;
    }
}
