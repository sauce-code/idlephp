<?php

namespace Idle\Logic\Buildings;

use Idle\Logic\Res;

class ConstructionYard extends AbstractBuilding
{

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

    public function upgrade()
    {
        // TODO: Implement upgrade() method.
    }
}