<?php

namespace Idle\Logic\Events;

use Idle\Logic\Buildings\AbstractBuilding;
use Idle\Logic\Res;

class ConstructionEvent extends AbstractEvent
{

    protected AbstractBuilding $building;
    protected Res $cost;

    public function __construct(int $date, AbstractBuilding $building, Res $cost)
    {
        parent::__construct($date);
        $this->building = $building;
        $this->cost = $cost;
    }

    public function fire()
    {
        // TODO: Implement fire() method.
    }
}