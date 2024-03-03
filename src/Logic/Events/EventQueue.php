<?php

namespace Idle\Logic\Events;

class EventQueue
{
    private array $events;

    public function add(AbstractEvent $event)
    {
        // TODO
    }

    public function getNext(): AbstractEvent
    {
        return $this->events[0];
    }
}
