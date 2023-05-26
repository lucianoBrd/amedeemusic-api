<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\EventPlan\Speaker;
use App\Entity\MailContent\EventPlan\Schedule;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\EventPlanRepository;

#[ORM\Entity(repositoryClass: EventPlanRepository::class)]
class EventPlan extends MailContent implements MailContentInterface
{

    #[ORM\OneToMany(mappedBy: 'eventPlan', targetEntity: Speaker::class)]
    private Collection $speakers;

    #[ORM\OneToMany(mappedBy: 'eventPlan', targetEntity: Schedule::class)]
    private Collection $schedules;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sectionSpeakerTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sectionScheduleTitle = null;

    #[ORM\Column(length: 600, nullable: true)]
    private ?string $scheduleParagraph = null;

    #[ORM\ManyToOne]
    private ?Button $firstScheduleButton = null;

    #[ORM\ManyToOne]
    private ?Button $secondScheduleButton = null;

    public function __construct()
    {
        $this->speakers = new ArrayCollection();
        $this->schedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Speaker>
     */
    public function getSpeakers(): Collection
    {
        return $this->speakers;
    }

    public function addSpeaker(Speaker $speaker): self
    {
        if (!$this->speakers->contains($speaker)) {
            $this->speakers->add($speaker);
            $speaker->setEventPlan($this);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): self
    {
        if ($this->speakers->removeElement($speaker)) {
            // set the owning side to null (unless already changed)
            if ($speaker->getEventPlan() === $this) {
                $speaker->setEventPlan(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Schedule>
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules->add($schedule);
            $schedule->setEventPlan($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getEventPlan() === $this) {
                $schedule->setEventPlan(null);
            }
        }

        return $this;
    }

    public function getSectionSpeakerTitle(): ?string
    {
        return $this->sectionSpeakerTitle;
    }

    public function setSectionSpeakerTitle(?string $sectionSpeakerTitle): self
    {
        $this->sectionSpeakerTitle = $sectionSpeakerTitle;

        return $this;
    }

    public function getSectionScheduleTitle(): ?string
    {
        return $this->sectionScheduleTitle;
    }

    public function setSectionScheduleTitle(?string $sectionScheduleTitle): self
    {
        $this->sectionScheduleTitle = $sectionScheduleTitle;

        return $this;
    }

    public function getScheduleParagraph(): ?string
    {
        return $this->scheduleParagraph;
    }

    public function setScheduleParagraph(?string $scheduleParagraph): self
    {
        $this->scheduleParagraph = $scheduleParagraph;

        return $this;
    }

    public function getFirstScheduleButton(): ?Button
    {
        return $this->firstScheduleButton;
    }

    public function setFirstScheduleButton(?Button $firstScheduleButton): self
    {
        $this->firstScheduleButton = $firstScheduleButton;

        return $this;
    }

    public function getSecondScheduleButton(): ?Button
    {
        return $this->secondScheduleButton;
    }

    public function setSecondScheduleButton(?Button $secondScheduleButton): self
    {
        $this->secondScheduleButton = $secondScheduleButton;

        return $this;
    }
}
