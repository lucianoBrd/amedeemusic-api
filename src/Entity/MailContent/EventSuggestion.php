<?php

namespace App\Entity\MailContent;

use App\Entity\MailContent\MailContent;
use App\Entity\MailContent\EventSuggestion\Event;
use App\Entity\MailContent\MailContentInterface;

class EventSuggestion extends MailContent implements MailContentInterface
{
    private array $events = [];

    public function __construct()
    {
        $this->events = [];
    }

    /**
     * @return array<Event>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!array_key_exists($event->getId(), $this->events)) {
            $this->events[$event->getId()] = $event;
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if (array_key_exists($event->getId(), $this->events)) {
            unset($this->events[$event->getId()]);
        }

        return $this;
    }
}
