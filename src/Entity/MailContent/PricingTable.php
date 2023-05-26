<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\PricingTable\Color;
use App\Entity\MailContent\MailContentInterface;
use App\Repository\MailContent\PricingTableRepository;

#[ORM\Entity(repositoryClass: PricingTableRepository::class)]
class PricingTable extends MailContent implements MailContentInterface
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $starterTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $advancedTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $starterSubTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $advancedSubTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $starterPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $advancedPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $starterDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $advancedDate = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $starterParagraph = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $advancedParagraph = null;

    #[ORM\ManyToOne]
    private ?Button $starterButton = null;

    #[ORM\ManyToOne]
    private ?Button $advancedButton = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStarterTitle(): ?string
    {
        return $this->starterTitle;
    }

    public function setStarterTitle(?string $starterTitle): self
    {
        $this->starterTitle = $starterTitle;

        return $this;
    }

    public function getAdvancedTitle(): ?string
    {
        return $this->advancedTitle;
    }

    public function setAdvancedTitle(?string $advancedTitle): self
    {
        $this->advancedTitle = $advancedTitle;

        return $this;
    }

    public function getStarterSubTitle(): ?string
    {
        return $this->starterSubTitle;
    }

    public function setStarterSubTitle(?string $starterSubTitle): self
    {
        $this->starterSubTitle = $starterSubTitle;

        return $this;
    }

    public function getAdvancedSubTitle(): ?string
    {
        return $this->advancedSubTitle;
    }

    public function setAdvancedSubTitle(?string $advancedSubTitle): self
    {
        $this->advancedSubTitle = $advancedSubTitle;

        return $this;
    }

    public function getStarterPrice(): ?string
    {
        return $this->starterPrice;
    }

    public function setStarterPrice(?string $starterPrice): self
    {
        $this->starterPrice = $starterPrice;

        return $this;
    }

    public function getAdvancedPrice(): ?string
    {
        return $this->advancedPrice;
    }

    public function setAdvancedPrice(?string $advancedPrice): self
    {
        $this->advancedPrice = $advancedPrice;

        return $this;
    }

    public function getStarterDate(): ?string
    {
        return $this->starterDate;
    }

    public function setStarterDate(?string $starterDate): self
    {
        $this->starterDate = $starterDate;

        return $this;
    }

    public function getAdvancedDate(): ?string
    {
        return $this->advancedDate;
    }

    public function setAdvancedDate(?string $advancedDate): self
    {
        $this->advancedDate = $advancedDate;

        return $this;
    }

    public function getStarterParagraph(): ?string
    {
        return $this->starterParagraph;
    }

    public function setStarterParagraph(?string $starterParagraph): self
    {
        $this->starterParagraph = $starterParagraph;

        return $this;
    }

    public function getAdvancedParagraph(): ?string
    {
        return $this->advancedParagraph;
    }

    public function setAdvancedParagraph(?string $advancedParagraph): self
    {
        $this->advancedParagraph = $advancedParagraph;

        return $this;
    }

    public function getStarterButton(): ?Button
    {
        return $this->starterButton;
    }

    public function setStarterButton(?Button $starterButton): self
    {
        $this->starterButton = $starterButton;

        return $this;
    }

    public function getAdvancedButton(): ?Button
    {
        return $this->advancedButton;
    }

    public function setAdvancedButton(?Button $advancedButton): self
    {
        $this->advancedButton = $advancedButton;

        return $this;
    }
}
