<?php

namespace Idle\Logic;

class AbstractCommand
{
    protected int $playerID;

    public function __construct(int $playerID)
    {
        $this->playerID = $playerID;
    }

    public function getPlayerID(): int
    {
        return $this->playerID;
    }
}
