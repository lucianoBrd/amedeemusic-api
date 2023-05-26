<?php

namespace App\Entity\MailContent\FreeGoods;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\FreeGoods;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\FreeGoods\Color;
use App\Repository\MailContent\FreeGoods\GoodRepository;

#[ORM\Entity(repositoryClass: GoodRepository::class)]
class Good
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    #[ORM\ManyToOne]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'twoColGoods')]
    private ?FreeGoods $freeGoods = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

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

    public function getFreeGoods(): ?FreeGoods
    {
        return $this->freeGoods;
    }

    public function setFreeGoods(?FreeGoods $freeGoods): self
    {
        $this->freeGoods = $freeGoods;

        return $this;
    }
}
