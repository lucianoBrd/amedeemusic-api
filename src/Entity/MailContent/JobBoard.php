<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\JobBoard\Job;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\JobBoard\Color;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\MailContent\JobBoardRepository;

#[ORM\Entity(repositoryClass: JobBoardRepository::class)]
class JobBoard extends MailContent implements MailContentInterface
{
    #[ORM\OneToMany(mappedBy: 'jobBoard', targetEntity: Job::class, cascade: ['persist', 'remove'])]
    private Collection $jobs;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Button $button = null;

    public function __construct()
    {
        parent::__construct();
        $this->jobs = new ArrayCollection();
        $this->color = Color::COLOR;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs->add($job);
            $job->setJobBoard($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getJobBoard() === $this) {
                $job->setJobBoard(null);
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
