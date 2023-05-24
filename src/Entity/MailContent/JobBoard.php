<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\JobBoard\Job;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\JobBoard\Color;
use App\Entity\MailContent\MailContentInterface;

class JobBoard extends MailContent implements MailContentInterface
{
    private array $jobs = [];
    private ?Button $button = null;

    public function __construct()
    {
        $this->jobs = [];
        $this->color = Color::COLOR;
    }

    /**
     * @return array<Job>
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!array_key_exists($job->getId(), $this->jobs)) {
            $this->jobs[$job->getId()] = $job;
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if (array_key_exists($job->getId(), $this->jobs)) {
            unset($this->jobs[$job->getId()]);
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
