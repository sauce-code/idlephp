<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

abstract class AbstractBuilding
{
    protected int $level;

    protected ConstructionYard $constructionYard;

    public function getLevel(): int
    {
        return $this->level;
    }

    abstract public function getUpgradeCost(): Res;

    abstract public function getUpgradeTime(): int;

    abstract public function upgrade(): void;
}
