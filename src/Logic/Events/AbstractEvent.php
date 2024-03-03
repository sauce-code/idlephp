<?php

namespace Idle\Logic\Events;

abstract class AbstractEvent
{

    protected int $date;

    protected function __construct(int $date)
    {
        $this->date = $date;
    }

    public function getDate() : int
    {
        return $this->date;
    }

    abstract public function fire();
}
