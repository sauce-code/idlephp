<?php

namespace Idle\Logic;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class UpgradeCommandTest extends TestCase
{

    public function testGetBuilding()
    {
        $command = new UpgradeCommand("0", "building");
        assertEquals("0", $command->getPlayerID());
        assertEquals("building", $command->getBuilding());
    }

}
