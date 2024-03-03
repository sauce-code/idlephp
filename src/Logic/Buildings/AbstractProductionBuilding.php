<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

abstract class AbstractProductionBuilding extends AbstractBuilding
{
    abstract public function getIncomeRate() : float;

    abstract public function getIncome(int $millis): Res;
}
