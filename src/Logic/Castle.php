<?php

namespace Idle\Logic;

use Idle\Logic\Buildings\AbstractBuilding;
use Idle\Logic\Buildings\ConstructionYard;
use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Logic\Events\EventQueue;
use Idle\Logic\Time\Clock;
use Idle\Logic\Time\Time;
use InvalidArgumentException;

class Castle
{
    private Time $time;
    private Res $res;
    private readonly LumberJack $lumberjack;
    private readonly StoneMason $stoneMason;
    private readonly Clock $clock;

    public function __construct(Time $time, Res $res, LumberJack $lumberjack, StoneMason $stoneMason, Clock $clock)
    {
        $this->time = $time;
        $this->res = $res;
        $this->lumberjack = $lumberjack;
        $this->stoneMason = $stoneMason;
        $this->clock = $clock;
    }

    public function upgrade(BuildingType $buildingType): void
    {
        $building = $this->getBuilding($buildingType);
        $cost = $building->getUpgradeCost();
        if ($this->res->has($cost)) {
            $this->res = $this->res->subtract($cost);
            $building->upgrade();
        }
    }

    private function getBuilding(BuildingType $building): AbstractBuilding
    {
        return match ($building) {
            BuildingType::LUMBER_JACK => $this->lumberjack,
            BuildingType::STONE_MASON => $this->stoneMason,
            default => throw new InvalidArgumentException()
        };
    }

    public function getRes(): Res
    {
        return $this->res;
    }

    public function update(): void
    {
        $now = $this->clock->getCurrentDate();
        $diff = $now->getMillis() - $this->time->getMillis();
        $this->res = $this->res->add($this->lumberjack->getIncome($diff));
        $this->res = $this->res->add($this->stoneMason->getIncome($diff));
        $this->time = $now;
    }

    public function getLevel(BuildingType $buildingType): int
    {
        return $this->getBuilding($buildingType)->getLevel();
    }

    public function getCost(BuildingType $buildingType): Res
    {
        return $this->getBuilding($buildingType)->getUpgradeCost();
    }

    public function getTime(): Time
    {
        return $this->time;
    }

    public function getIncome(): Res
    {
        return new Res(
            $this->lumberjack->getIncome(1_000)->getLumber(),
            $this->stoneMason->getIncome(1_000)->getStone()
        );
    }
}
