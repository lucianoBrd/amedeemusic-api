<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\EventPlan\Speaker;
use App\Entity\MailContent\EventPlan\Schedule;
use App\Entity\MailContent\MailContentInterface;

class EventPlan extends MailContent implements MailContentInterface
{
    private array $speakers = [];
    private array $schedules = [];
    private ?string $sectionSpeakerTitle = null;
    private ?string $sectionScheduleTitle = null;
    private ?string $scheduleParagraph = null;
    private ?Button $firstScheduleButton = null;
    private ?Button $secondScheduleButton = null;

    public function __construct()
    {
        $this->speakers = [];
        $this->schedules = [];
    }

    /**
     * @return array<Speaker>
     */
    public function getSpeakers(): array
    {
        return $this->speakers;
    }

    public function addSpeaker(Speaker $speaker): self
    {
        if (!array_key_exists($speaker->getId(), $this->speakers)) {
            $this->speakers[$speaker->getId()] = $speaker;
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): self
    {
        if (array_key_exists($speaker->getId(), $this->speakers)) {
            unset($this->speakers[$speaker->getId()]);
        }

        return $this;
    }

	/**
     * @return array<Schedule>
     */
    public function getSchedules(): array
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!array_key_exists($schedule->getId(), $this->schedules)) {
            $this->schedules[$schedule->getId()] = $schedule;
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if (array_key_exists($schedule->getId(), $this->schedules)) {
            unset($this->schedules[$schedule->getId()]);
        }

        return $this;
    }

	/**
	 * @return 
	 */
	public function getSectionSpeakerTitle(): ?string {
		return $this->sectionSpeakerTitle;
	}
	
	/**
	 * @param  $sectionSpeakerTitle 
	 * @return self
	 */
	public function setSectionSpeakerTitle(?string $sectionSpeakerTitle): self {
		$this->sectionSpeakerTitle = $sectionSpeakerTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSectionScheduleTitle(): ?string {
		return $this->sectionScheduleTitle;
	}
	
	/**
	 * @param  $sectionScheduleTitle 
	 * @return self
	 */
	public function setSectionScheduleTitle(?string $sectionScheduleTitle): self {
		$this->sectionScheduleTitle = $sectionScheduleTitle;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getScheduleParagraph(): ?string {
		return $this->scheduleParagraph;
	}
	
	/**
	 * @param  $scheduleParagraph 
	 * @return self
	 */
	public function setScheduleParagraph(?string $scheduleParagraph): self {
		$this->scheduleParagraph = $scheduleParagraph;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getFirstScheduleButton(): ?Button {
		return $this->firstScheduleButton;
	}
	
	/**
	 * @param  $firstScheduleButton 
	 * @return self
	 */
	public function setFirstScheduleButton(?Button $firstScheduleButton): self {
		$this->firstScheduleButton = $firstScheduleButton;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getSecondScheduleButton(): ?Button {
		return $this->secondScheduleButton;
	}
	
	/**
	 * @param  $secondScheduleButton 
	 * @return self
	 */
	public function setSecondScheduleButton(?Button $secondScheduleButton): self {
		$this->secondScheduleButton = $secondScheduleButton;
		return $this;
	}
}
