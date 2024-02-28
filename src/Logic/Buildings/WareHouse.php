<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

class WareHouse extends AbstractBuilding
{
    private Res $res;

    public function getUpgradeCost(): Res
    {
        // TODO: Implement getUpgradeCost() method.
    }

    public function getUpgradeTime(): int
    {
        // TODO: Implement getUpgradeTime() method.
    }

    public function upgrade(): void
    {
        // TODO: Implement upgrade() method.
    }

    public function getRes(): Res
    {
        return $this->res;
    }

    public function setRes(Res $res): void
    {
        $this->res = $res;
    }

}
