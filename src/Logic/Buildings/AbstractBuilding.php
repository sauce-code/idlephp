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

    public abstract function getUpgradeCost(): Res;

    public abstract function getUpgradeTime(): int;

    public abstract function upgrade(): void;
}