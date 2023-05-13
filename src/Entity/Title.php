<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TitleRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TitleRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ],
    order: ['name' => 'ASC'],
    paginationEnabled: false
)]
class Title
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['project:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['project:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['project:read'])]
    private ?string $lyrics = null;

    #[ORM\ManyToOne(inversedBy: 'titles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\OneToMany(mappedBy: 'title', targetEntity: TitlePlatform::class, cascade: ['persist', 'remove'])]
    #[Groups(['project:read'])]
    private Collection $titlePlatforms;

    public function __construct()
    {
        $this->titlePlatforms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLyrics(): ?string
    {
        return $this->lyrics;
    }

    public function setLyrics(?string $lyrics): self
    {
        $this->lyrics = $lyrics;

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

    /**
     * @return Collection<int, TitlePlatform>
     */
    public function getTitlePlatforms(): Collection
    {
        return $this->titlePlatforms;
    }

    public function addTitlePlatform(TitlePlatform $titlePlatform): self
    {
        if (!$this->titlePlatforms->contains($titlePlatform)) {
            $this->titlePlatforms->add($titlePlatform);
            $titlePlatform->setTitle($this);
        }

        return $this;
    }

    public function removeTitlePlatform(TitlePlatform $titlePlatform): self
    {
        if ($this->titlePlatforms->removeElement($titlePlatform)) {
            // set the owning side to null (unless already changed)
            if ($titlePlatform->getTitle() === $this) {
                $titlePlatform->setTitle(null);
            }
        }

        return $this;
    }
}
