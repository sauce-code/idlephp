<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

abstract class AbstractProductionBuilding extends AbstractBuilding
{
    public abstract function getIncomeRate() : float;

    public abstract function getIncome(int $millis): Res;
}
