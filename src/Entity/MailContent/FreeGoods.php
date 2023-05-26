<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\FreeGoods\Good;
use App\Entity\MailContent\FreeGoods\Color;
use App\Entity\MailContent\MailContentInterface;

class FreeGoods extends MailContent implements MailContentInterface
{
    private array $twoColGoods = [];
    private array $threeColGoods = [];

    public function __construct()
    {
        $this->twoColGoods = [];
        $this->threeColGoods = [];
        $this->color = Color::COLOR;
    }

    /**
     * @return array<Good>
     */
    public function getTwoColGoods(): array
    {
        return $this->twoColGoods;
    }

    public function addTwoColGood(Good $good): self
    {
        if (!array_key_exists($good->getId(), $this->twoColGoods)) {
            $this->twoColGoods[$good->getId()] = $good;
        }

        return $this;
    }

    public function removeTwoColGood(Good $good): self
    {
        if (array_key_exists($good->getId(), $this->twoColGoods)) {
            unset($this->twoColGoods[$good->getId()]);
        }

        return $this;
    }

    /**
     * @return array<Good>
     */
    public function getThreeColGoods(): array
    {
        return $this->threeColGoods;
    }

    public function addThreeColGood(Good $good): self
    {
        if (!array_key_exists($good->getId(), $this->threeColGoods)) {
            $this->threeColGoods[$good->getId()] = $good;
        }

        return $this;
    }

    public function removeThreeColGood(Good $good): self
    {
        if (array_key_exists($good->getId(), $this->threeColGoods)) {
            unset($this->threeColGoods[$good->getId()]);
        }

        return $this;
    }
}
