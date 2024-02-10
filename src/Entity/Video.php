<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideoRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Controller\Api\GetLastVideoController;
use App\Controller\Api\GetLastsVideoController;
use App\Controller\Api\GetFilterVideoController;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            name: 'lastsVideo', 
            uriTemplate: '/videos/lasts', 
            controller: GetLastsVideoController::class,
            read: false,
            normalizationContext: ['groups' => 'video:read']
        ),
        new GetCollection(
            name: 'filterVideo', 
            uriTemplate: '/videos/filter', 
            controller: GetFilterVideoController::class,
            read: false,
            normalizationContext: ['groups' => 'video:read']
        ),
        new Get(
            name: 'lastVideoLight', 
            uriTemplate: '/videos/last/light', 
            controller: GetLastVideoController::class,
            read: false,
            normalizationContext: ['groups' => 'video:read:light']
        ),
        new GetCollection(
            normalizationContext: ['groups' => 'video:read']
        ),
        new Get(
            normalizationContext: ['groups' => 'video:read']
        )
    ],
    order: ['id' => 'DESC'],
    paginationEnabled: true,
    paginationItemsPerPage: Data::PAGINATION_ITEMS_PER_PAGE
)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['video:read', 'video:read:light'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video:read', 'video:read:light'])]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video:read', 'video:read:light'])]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video:read', 'video:read:light'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['video:read', 'video:read:light'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoDescription::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups(['video:read'])]
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
