<?php

namespace App\Entity\MailContent;

use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\Shared\Text;

interface MailContentInterface
{
    public function getId(): ?int;
    public function getTitle(): ?string;
    public function setTitle(?string $title): self;
    public function getTitleBold(): ?string;
    public function setTitleBold(?string $titleBold): self;
    public function getColor(): ?string;
    public function setColor(?string $color): self;
    public function getTexts(): Collection;
    public function addText(Text $text): self;
    public function removeText(Text $text): self;
}
