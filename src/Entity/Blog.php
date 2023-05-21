<?php

namespace App\Entity;

use App\Entity\Data;
use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BlogRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Controller\Api\GetLastsBlogController;
use App\Controller\Api\GetFilterBlogController;
use App\Controller\Api\GetRandomsBlogController;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            name: 'randomsBlog', 
            uriTemplate: '/blogs/randoms', 
            controller: GetRandomsBlogController::class,
            read: false,
            normalizationContext: ['groups' => 'blog:read:collection']
        ),
        new GetCollection(
            name: 'lastsBlog', 
            uriTemplate: '/blogs/lasts', 
            controller: GetLastsBlogController::class,
            read: false,
            normalizationContext: ['groups' => 'blog:read:collection']
        ),
        new GetCollection(
            name: 'filterBlog', 
            uriTemplate: '/blogs/filter', 
            controller: GetFilterBlogController::class,
            read: false,
            normalizationContext: ['groups' => 'blog:read:collection']
        ),
        new GetCollection(
            normalizationContext: ['groups' => 'blog:read:collection']
        ),
        new Get(
            normalizationContext: ['groups' => 'blog:read']
        ),
    ],
    order: ['date' => 'DESC'],
    paginationEnabled: true,
    paginationItemsPerPage: Data::PAGINATION_ITEMS_PER_PAGE
)]
#[ApiFilter(SearchFilter::class, properties: ['local.local' => 'exact'])]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['blog:read', 'blog:read:collection'])]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    private ?string $title = null;

    #[ORM\Column(length: 350, unique: true)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    #[ApiProperty(identifier: true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['blog:read', 'blog:read:collection'])]
    private ?Local $local = null;

    public function __construct()
    {
        $this->blogContents = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->slug . ' - ' . $this->local->__toString();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
