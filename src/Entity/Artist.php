<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use App\Controller\Api\GetLastArtistController;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            name: 'lastArtist', 
            uriTemplate: '/artists/last', 
            controller: GetLastArtistController::class,
            read: false,
            normalizationContext: ['groups' => 'artist:read']
        ),
        new Get(
            name: 'lastArtistLight', 
            uriTemplate: '/artists/last/light', 
            controller: GetLastArtistController::class,
            read: false,
            normalizationContext: ['groups' => 'artist:read:light']
        )
    ],
    order: ['id' => 'ASC'],
    paginationEnabled: false
)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $man = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $header = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $project = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $gallery = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $video = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $videosLink = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $blog = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $subscribe = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $testimonial = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: ArtistAbout::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups(['artist:read'])]
    private Collection $artistAbouts;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['artist:read', 'artist:read:light'])]
    private ?string $footer = null;

    public function __construct()
    {
        $this->artistAbouts = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMan(): ?string
    {
        return $this->man;
    }

    public function setMan(string $man): self
    {
        $this->man = $man;

        return $this;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(?string $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(?string $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getGallery(): ?string
    {
        return $this->gallery;
    }

    public function setGallery(?string $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getVideosLink(): ?string
    {
        return $this->videosLink;
    }

    public function setVideosLink(string $videosLink): self
    {
        $this->videosLink = $videosLink;

        return $this;
    }

    public function getBlog(): ?string
    {
        return $this->blog;
    }

    public function setBlog(?string $blog): self
    {
        $this->blog = $blog;

        return $this;
    }

    public function getSubscribe(): ?string
    {
        return $this->subscribe;
    }

    public function setSubscribe(?string $subscribe): self
    {
        $this->subscribe = $subscribe;

        return $this;
    }

    public function getTestimonial(): ?string
    {
        return $this->testimonial;
    }

    public function setTestimonial(?string $testimonial): self
    {
        $this->testimonial = $testimonial;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

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

    /**
     * @return Collection<int, ArtistAbout>
     */
    public function getArtistAbouts(): Collection
    {
        return $this->artistAbouts;
    }

    public function addArtistAbout(ArtistAbout $artistAbout): self
    {
        if (!$this->artistAbouts->contains($artistAbout)) {
            $this->artistAbouts->add($artistAbout);
            $artistAbout->setArtist($this);
        }

        return $this;
    }

    public function removeArtistAbout(ArtistAbout $artistAbout): self
    {
        if ($this->artistAbouts->removeElement($artistAbout)) {
            // set the owning side to null (unless already changed)
            if ($artistAbout->getArtist() === $this) {
                $artistAbout->setArtist(null);
            }
        }

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }
}
