<?php

namespace App\Entity\MailContent;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\MailContent\MailContent;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\MailContentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\MailContent\EventSuggestion\Event;
use App\Repository\MailContent\EventSuggestionRepository;

#[ORM\Entity(repositoryClass: EventSuggestionRepository::class)]
class EventSuggestion extends MailContent implements MailContentInterface
{
    #[ORM\OneToMany(mappedBy: 'eventSuggestion', targetEntity: Event::class, cascade: ['persist', 'remove'])]
    private Collection $events;

    public function __construct()
    {
        parent::__construct();
        $this->events = new ArrayCollection();
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setEventSuggestion($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEventSuggestion() === $this) {
                $event->setEventSuggestion(null);
            }
        }

        return $this;
    }
}
