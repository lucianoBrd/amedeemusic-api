<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ApiResource]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoDescription::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $videoDescriptions;

    public function __construct()
    {
        $this->videoDescriptions = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, VideoDescription>
     */
    public function getVideoDescriptions(): Collection
    {
        return $this->videoDescriptions;
    }

    public function addVideoDescription(VideoDescription $videoDescription): self
    {
        if (!$this->videoDescriptions->contains($videoDescription)) {
            $this->videoDescriptions->add($videoDescription);
            $videoDescription->setVideo($this);
        }

        return $this;
    }

    public function removeVideoDescription(VideoDescription $videoDescription): self
    {
        if ($this->videoDescriptions->removeElement($videoDescription)) {
            // set the owning side to null (unless already changed)
            if ($videoDescription->getVideo() === $this) {
                $videoDescription->setVideo(null);
            }
        }

        return $this;
    }
}
