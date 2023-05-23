<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\MailContentInterface;

class UserWelcoming extends MailContent implements MailContentInterface
{
	private ?Button $button = null;
	private ?string $lLabel = null;
	private ?string $rLabel = null;
	private ?string $lInfo = null;
	private ?string $rInfo = null;

    public function __construct()
    {
        $this->color = 'FF4133';
    }

	/**
	 * @return 
	 */
	public function getButton(): ?Button {
		return $this->button;
	}
	
	/**
	 * @param  $button 
	 * @return self
	 */
	public function setButton(?Button $button): self {
		$this->button = $button;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getLLabel(): ?string {
		return $this->lLabel;
	}
	
	/**
	 * @param  $lLabel 
	 * @return self
	 */
	public function setLLabel(?string $lLabel): self {
		$this->lLabel = $lLabel;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getRLabel(): ?string {
		return $this->rLabel;
	}
	
	/**
	 * @param  $rLabel 
	 * @return self
	 */
	public function setRLabel(?string $rLabel): self {
		$this->rLabel = $rLabel;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getLInfo(): ?string {
		return $this->lInfo;
	}
	
	/**
	 * @param  $lInfo 
	 * @return self
	 */
	public function setLInfo(?string $lInfo): self {
		$this->lInfo = $lInfo;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getRInfo(): ?string {
		return $this->rInfo;
	}
	
	/**
	 * @param  $rInfo 
	 * @return self
	 */
	public function setRInfo(?string $rInfo): self {
		$this->rInfo = $rInfo;
		return $this;
	}
}
