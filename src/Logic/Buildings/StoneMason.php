<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

class StoneMason extends AbstractProductionBuilding
{
    const INCOME_RATE_BASE = 1.1;
    const INCOME_RATE_EXPONENT = .007;

    public function getIncomeRate(): float
    {
        return self::INCOME_RATE_BASE ^ $this->level * self::INCOME_RATE_EXPONENT;
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
