<?php

namespace Idle\Logic;

class UpgradeCommand extends AbstractCommand
{
    private string $building;

    public function __construct(string $playerID, string $building)
    {
        parent::__construct($playerID);
        $this->building = $building;
    }

    public function getBuilding(): string
    {
        return $this->building;
    }
}
