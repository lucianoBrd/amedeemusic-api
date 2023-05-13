<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ProjectPlatformRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjectPlatformRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ],
    order: ['fa' => 'ASC'],
    paginationEnabled: false
)]
class ProjectPlatform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['project:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['project:read'])]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    #[Groups(['project:read'])]
    private ?string $fa = null;

    #[ORM\ManyToOne(inversedBy: 'projectPlatforms')]
    private ?Project $project = null;

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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
