<?php

namespace Idle\Logic\Time;

class Time
{
    private int $millis;

    public function __construct(int $millis)
    {
        $this->millis = $millis;
    }

    public function getMillis(): int
    {
        return $this->millis;
    }
}
