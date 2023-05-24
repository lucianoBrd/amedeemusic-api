<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\PricingTable\Color;
use App\Entity\MailContent\MailContentInterface;

class PricingTable extends MailContent implements MailContentInterface
{
    private ?string $starterTitle = null;
    private ?string $advancedTitle = null;
    private ?string $starterSubTitle = null;
    private ?string $advancedSubTitle = null;
    private ?string $starterPrice = null;
    private ?string $advancedPrice = null;
    private ?string $starterDate = null;
    private ?string $advancedDate = null;
    private ?string $starterParagraph = null;
    private ?string $advancedParagraph = null;
    private ?Button $starterButton = null;
    private ?Button $advancedButton = null;

    public function __construct()
    {
        $this->color = Color::COLOR;
    }

	/**
	 * @return 
	 */
	public function getStarterTitle(): ?string {
		return $this->starterTitle;
	}
	
	/**
	 * @param  $starterTitle 
	 * @return self
	 */
	public function setStarterTitle(?string $starterTitle): self {
		$this->starterTitle = $starterTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedTitle(): ?string {
		return $this->advancedTitle;
	}
	
	/**
	 * @param  $advancedTitle 
	 * @return self
	 */
	public function setAdvancedTitle(?string $advancedTitle): self {
		$this->advancedTitle = $advancedTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getStarterSubTitle(): ?string {
		return $this->starterSubTitle;
	}
	
	/**
	 * @param  $starterSubTitle 
	 * @return self
	 */
	public function setStarterSubTitle(?string $starterSubTitle): self {
		$this->starterSubTitle = $starterSubTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedSubTitle(): ?string {
		return $this->advancedSubTitle;
	}
	
	/**
	 * @param  $advancedSubTitle 
	 * @return self
	 */
	public function setAdvancedSubTitle(?string $advancedSubTitle): self {
		$this->advancedSubTitle = $advancedSubTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getStarterPrice(): ?string {
		return $this->starterPrice;
	}
	
	/**
	 * @param  $starterPrice 
	 * @return self
	 */
	public function setStarterPrice(?string $starterPrice): self {
		$this->starterPrice = $starterPrice;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedPrice(): ?string {
		return $this->advancedPrice;
	}
	
	/**
	 * @param  $advancedPrice 
	 * @return self
	 */
	public function setAdvancedPrice(?string $advancedPrice): self {
		$this->advancedPrice = $advancedPrice;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getStarterDate(): ?string {
		return $this->starterDate;
	}
	
	/**
	 * @param  $starterDate 
	 * @return self
	 */
	public function setStarterDate(?string $starterDate): self {
		$this->starterDate = $starterDate;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedDate(): ?string {
		return $this->advancedDate;
	}
	
	/**
	 * @param  $advancedDate 
	 * @return self
	 */
	public function setAdvancedDate(?string $advancedDate): self {
		$this->advancedDate = $advancedDate;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getStarterParagraph(): ?string {
		return $this->starterParagraph;
	}
	
	/**
	 * @param  $starterParagraph 
	 * @return self
	 */
	public function setStarterParagraph(?string $starterParagraph): self {
		$this->starterParagraph = $starterParagraph;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedParagraph(): ?string {
		return $this->advancedParagraph;
	}
	
	/**
	 * @param  $advancedParagraph 
	 * @return self
	 */
	public function setAdvancedParagraph(?string $advancedParagraph): self {
		$this->advancedParagraph = $advancedParagraph;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getStarterButton(): ?Button {
		return $this->starterButton;
	}
	
	/**
	 * @param  $starterButton 
	 * @return self
	 */
	public function setStarterButton(?Button $starterButton): self {
		$this->starterButton = $starterButton;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getAdvancedButton(): ?Button {
		return $this->advancedButton;
	}
	
	/**
	 * @param  $advancedButton 
	 * @return self
	 */
	public function setAdvancedButton(?Button $advancedButton): self {
		$this->advancedButton = $advancedButton;
		return $this;
	}
}
