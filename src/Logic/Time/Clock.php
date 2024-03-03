<?php

namespace Idle\Logic\Time;

class Clock
{
    public function getCurrentDate(): Time
    {
        return new Time(time());
    }
}
