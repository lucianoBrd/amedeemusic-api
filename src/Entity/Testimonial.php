<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestimonialRepository::class)]
#[ApiResource]
class Testimonial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $citation = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'testimonials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Local $local = null;

    public function __toString(): string
    {
        return $this->name . ' - ' . $this->local->__toString();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCitation(): ?string
    {
        return $this->citation;
    }

    public function setCitation(string $citation): self
    {
        $this->citation = $citation;

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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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
