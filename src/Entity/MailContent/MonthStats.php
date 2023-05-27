<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\MonthStats\Stat;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\MonthStats\Color;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\MonthStatsRepository;

#[ORM\Entity(repositoryClass: MonthStatsRepository::class)]
class MonthStats extends MailContent implements MailContentInterface
{
    #[ORM\OneToMany(mappedBy: 'monthStats', targetEntity: Stat::class, cascade: ['persist', 'remove'])]
    private Collection $stats;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Button $button = null;

    public function __construct()
    {
        parent::__construct();
        $this->stats = new ArrayCollection();
        $this->color = Color::COLOR;
    }

    /**
     * @return Collection<int, Stat>
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stat $stat): self
    {
        if (!$this->stats->contains($stat)) {
            $this->stats->add($stat);
            $stat->setMonthStats($this);
        }

        return $this;
    }

    public function removeStat(Stat $stat): self
    {
        if ($this->stats->removeElement($stat)) {
            // set the owning side to null (unless already changed)
            if ($stat->getMonthStats() === $this) {
                $stat->setMonthStats(null);
            }
        }

        return $this;
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
}
