<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LocalRepository;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LocalRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ],
    order: ['local' => 'ASC'],
    paginationEnabled: false
)]
class Local
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['artist:read', 'video:read'])]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artist:read', 'video:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['artist:read', 'video:read'])]
    #[ApiProperty(identifier: true)]
    private ?string $local = null;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Testimonial::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $testimonials;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Politic::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $politics;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: ArtistAbout::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $artistAbouts;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: VideoDescription::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $videoDescriptions;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Blog::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $blogs;

    public function __construct()
    {
        $this->testimonials = new ArrayCollection();
        $this->politics = new ArrayCollection();
        $this->artistAbouts = new ArrayCollection();
        $this->videoDescriptions = new ArrayCollection();
        $this->blogs = new ArrayCollection();
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

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(string $local): self
    {
        $this->local = $local;

        return $this;
    }

    /**
     * @return Collection<int, Testimonial>
     */
    public function getTestimonials(): Collection
    {
        return $this->testimonials;
    }

    public function addTestimonial(Testimonial $testimonial): self
    {
        if (!$this->testimonials->contains($testimonial)) {
            $this->testimonials->add($testimonial);
            $testimonial->setLocal($this);
        }

        return $this;
    }

    public function removeTestimonial(Testimonial $testimonial): self
    {
        if ($this->testimonials->removeElement($testimonial)) {
            // set the owning side to null (unless already changed)
            if ($testimonial->getLocal() === $this) {
                $testimonial->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Politic>
     */
    public function getPolitics(): Collection
    {
        return $this->politics;
    }

    public function addPolitic(Politic $politic): self
    {
        if (!$this->politics->contains($politic)) {
            $this->politics->add($politic);
            $politic->setLocal($this);
        }

        return $this;
    }

    public function removePolitic(Politic $politic): self
    {
        if ($this->politics->removeElement($politic)) {
            // set the owning side to null (unless already changed)
            if ($politic->getLocal() === $this) {
                $politic->setLocal(null);
            }
        }

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
            $artistAbout->setLocal($this);
        }

        return $this;
    }

    public function removeArtistAbout(ArtistAbout $artistAbout): self
    {
        if ($this->artistAbouts->removeElement($artistAbout)) {
            // set the owning side to null (unless already changed)
            if ($artistAbout->getLocal() === $this) {
                $artistAbout->setLocal(null);
            }
        }

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
            $videoDescription->setLocal($this);
        }

        return $this;
    }

    public function removeVideoDescription(VideoDescription $videoDescription): self
    {
        if ($this->videoDescriptions->removeElement($videoDescription)) {
            // set the owning side to null (unless already changed)
            if ($videoDescription->getLocal() === $this) {
                $videoDescription->setLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Blog>
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs->add($blog);
            $blog->setLocal($this);
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        if ($this->blogs->removeElement($blog)) {
            // set the owning side to null (unless already changed)
            if ($blog->getLocal() === $this) {
                $blog->setLocal(null);
            }
        }

        return $this;
    }
}
