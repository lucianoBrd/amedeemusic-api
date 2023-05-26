<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\FreeGoods\Good;
use App\Entity\MailContent\FreeGoods\Color;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\FreeGoodsRepository;

#[ORM\Entity(repositoryClass: FreeGoodsRepository::class)]
class FreeGoods extends MailContent implements MailContentInterface
{

    #[ORM\OneToMany(mappedBy: 'freeGoods', targetEntity: Good::class)]
    private Collection $twoColGoods;

    #[ORM\OneToMany(mappedBy: 'freeGoods', targetEntity: Good::class)]
    private Collection $threeColGoods;

    public function __construct()
    {
        $this->twoColGoods = new ArrayCollection();
        $this->threeColGoods = new ArrayCollection();
        $this->color = Color::COLOR;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Good>
     */
    public function getTwoColGoods(): Collection
    {
        return $this->twoColGoods;
    }

    public function addTwoColGood(Good $twoColGood): self
    {
        if (!$this->twoColGoods->contains($twoColGood)) {
            $this->twoColGoods->add($twoColGood);
            $twoColGood->setFreeGoods($this);
        }

        return $this;
    }

    public function removeTwoColGood(Good $twoColGood): self
    {
        if ($this->twoColGoods->removeElement($twoColGood)) {
            // set the owning side to null (unless already changed)
            if ($twoColGood->getFreeGoods() === $this) {
                $twoColGood->setFreeGoods(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Good>
     */
    public function getThreeColGoods(): Collection
    {
        return $this->threeColGoods;
    }

    public function addThreeColGood(Good $threeColGood): self
    {
        if (!$this->threeColGoods->contains($threeColGood)) {
            $this->threeColGoods->add($threeColGood);
            $threeColGood->setFreeGoods($this);
        }

        return $this;
    }

    public function removeThreeColGood(Good $threeColGood): self
    {
        if ($this->threeColGoods->removeElement($threeColGood)) {
            // set the owning side to null (unless already changed)
            if ($threeColGood->getFreeGoods() === $this) {
                $threeColGood->setFreeGoods(null);
            }
        }

        return $this;
    }
}
