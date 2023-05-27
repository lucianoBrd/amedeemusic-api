<?php

namespace App\Entity\MailContent\EventPlan;

use App\Entity\MailContent\EventPlan;
use App\Repository\MailContent\EventPlan\ScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hour = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $paragraphs = [];

    #[ORM\ManyToOne(inversedBy: 'schedules', cascade: ['persist'])]
    private ?EventPlan $eventPlan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(?string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getParagraphs(): array
    {
        return $this->paragraphs;
    }

    public function setParagraphs(?array $paragraphs): self
    {
        $this->paragraphs = $paragraphs;

        return $this;
    }

    public function getEventPlan(): ?EventPlan
    {
        return $this->eventPlan;
    }

    public function setEventPlan(?EventPlan $eventPlan): self
    {
        $this->eventPlan = $eventPlan;

        return $this;
    }
}
