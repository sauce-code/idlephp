<?php

namespace Idle\Logic;

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
    private readonly ConstructionYard $constructionYard;
    private readonly LumberJack $lumberjack;
    private readonly StoneMason $stoneMason;
    private readonly EventQueue $eventQueue;
    private readonly Clock $clock;

    public function __construct(Time $time, Res $res, LumberJack $lumberjack, StoneMason $stoneMason, Clock $clock)
    {
        $this->time = $time;
        $this->res = $res;
        $this->lumberjack = $lumberjack;
        $this->stoneMason = $stoneMason;
        $this->clock = $clock;
    }

    public function upgrade(string $building): void
    {
        switch ($building) {
            case ConstructionYard::class:
                $this->constructionYard->upgrade();
                break;
            case LumberJack::class:
                $this->lumberjack->upgrade();
                break;
            case StoneMason::class:
                $this->stoneMason->upgrade();
                break;
            default:
                throw new InvalidArgumentException();
        }
    }

    public function getRes(): Res
    {
        return $this->res;
    }

    public function update(): void
    {
        $now = $this->clock->getCurrentDate();
        $diff = $now->getMillis() - $this->time->getMillis();
        $this->res->add($this->lumberjack->getIncome($diff));
        $this->res->add($this->stoneMason->getIncome($diff));
    }

    public function getLevel(string $building): int
    {
        return match ($building) {
            ConstructionYard::class => $this->constructionYard->getLevel(),
            LumberJack::class => $this->lumberjack->getLevel(),
            StoneMason::class => $this->stoneMason->getLevel(),
            default => throw new InvalidArgumentException(),
        };
    }

    public function getCost(string $building): Res
    {
        return match ($building) {
            LumberJack::class => $this->lumberjack->getUpgradeCost(),
            StoneMason::class => $this->stoneMason->getUpgradeCost(),
            default => throw new InvalidArgumentException(),
        };
    }
}
