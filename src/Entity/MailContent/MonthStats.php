<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\MonthStats\Stat;
use App\Entity\MailContent\MonthStats\Color;
use App\Entity\MailContent\MailContentInterface;

class MonthStats extends MailContent implements MailContentInterface
{
    private array $stats = [];
    private ?Button $button = null;

    public function __construct()
    {
        $this->stats = [];
        $this->color = Color::COLOR;
    }

    /**
     * @return array<Stat>
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    public function addStat(Stat $stat): self
    {
        if (!array_key_exists($stat->getId(), $this->stats)) {
            $this->stats[$stat->getId()] = $stat;
        }

        return $this;
    }

    public function removeStat(Stat $stat): self
    {
        if (array_key_exists($stat->getId(), $this->stats)) {
            unset($this->stats[$stat->getId()]);
        }

        return $this;
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
}
