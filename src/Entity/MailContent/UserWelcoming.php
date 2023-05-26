<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming\Color;
use App\Entity\MailContent\MailContentInterface;
use App\Repository\MailContent\UserWelcomingRepository;

#[ORM\Entity(repositoryClass: UserWelcomingRepository::class)]
class UserWelcoming extends MailContent implements MailContentInterface
{

    #[ORM\ManyToOne]
    private ?Button $button = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lLabel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rLabel = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $lInfo = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $rInfo = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getButton(): ?Button
    {
        return $this->button;
    }

    public function setButton(?Button $button): self
    {
        $this->button = $button;

        return $this;
    }

    public function getLLabel(): ?string
    {
        return $this->lLabel;
    }

    public function setLLabel(?string $lLabel): self
    {
        $this->lLabel = $lLabel;

        return $this;
    }

    public function getRLabel(): ?string
    {
        return $this->rLabel;
    }

    public function setRLabel(?string $rLabel): self
    {
        $this->rLabel = $rLabel;

        return $this;
    }

    public function getLInfo(): ?string
    {
        return $this->lInfo;
    }

    public function setLInfo(?string $lInfo): self
    {
        $this->lInfo = $lInfo;

        return $this;
    }

    public function getRInfo(): ?string
    {
        return $this->rInfo;
    }

    public function setRInfo(?string $rInfo): self
    {
        $this->rInfo = $rInfo;

        return $this;
    }
}
