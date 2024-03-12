<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

class LumberJack extends AbstractProductionBuilding
{

    public function getIncomeRate(): float
    {
        return 1.1 ^ $this->level * .1;
    }

    public function getIncome(int $millis): Res
    {
        return new Res(
            $this->getIncomeRate() * $millis,
            0
        );
    }

    public function getUpgradeCost(): Res
    {
        return new Res(
            1.1 ^ $this->level * 1.1,
            1.1 ^ $this->level * 1.2
        );
    }

    public function getUpgradeTime(): int
    {
        return 100 * 1.1 ^ $this->level / $this->constructionYard->level;
    }

    public function upgrade(): void
    {
        // TODO: Implement upgrade() method.
    }
}
