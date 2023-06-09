<?php

namespace App\Entity\MailContent\BlogArticles;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\BlogArticles\Color;
use App\Repository\MailContent\BlogArticles\ArticleRepository;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $paragraph = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paragraphBold = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'articles', cascade: ['persist'])]
    private ?BlogArticles $blogArticles = null;

    public function __construct()
    {
        $this->color = Color::COLORS[array_rand(Color::COLORS)];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(?string $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getParagraphBold(): ?string
    {
        return $this->paragraphBold;
    }

    public function setParagraphBold(?string $paragraphBold): self
    {
        $this->paragraphBold = $paragraphBold;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBlogArticles(): ?BlogArticles
    {
        return $this->blogArticles;
    }

    public function setBlogArticles(?BlogArticles $blogArticles): self
    {
        $this->blogArticles = $blogArticles;

        return $this;
    }
}
