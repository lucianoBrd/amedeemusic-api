<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
#[ApiResource]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'blog', targetEntity: BlogContent::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $blogContents;

    #[ORM\Column(length: 350, unique: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->blogContents = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->slug;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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

    /**
     * @return Collection<int, BlogContent>
     */
    public function getBlogContents(): Collection
    {
        return $this->blogContents;
    }

    public function addBlogContent(BlogContent $blogContent): self
    {
        if (!$this->blogContents->contains($blogContent)) {
            $this->blogContents->add($blogContent);
            $blogContent->setBlog($this);
        }

        return $this;
    }

    public function removeBlogContent(BlogContent $blogContent): self
    {
        if ($this->blogContents->removeElement($blogContent)) {
            // set the owning side to null (unless already changed)
            if ($blogContent->getBlog() === $this) {
                $blogContent->setBlog(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
