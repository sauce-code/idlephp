<?php

namespace Idle\Logic;

use http\Exception\InvalidArgumentException;
use Idle\Logic\Buildings\ConstructionYard;
use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Logic\Events\EventQueue;
use Idle\Logic\Time\Clock;

class Castle
{
    private int $time;
    private Res $res;
    private ConstructionYard $constructionYard;
    private LumberJack $lumberjack;
    private StoneMason $stoneMason;
    private EventQueue $eventQueue;
    private Clock $clock;

    /**
     * @param ConstructionYard $constructionYard
     * @param LumberJack $lumberjack
     * @param StoneMason $stoneMason
     */
    public function __construct(ConstructionYard $constructionYard, LumberJack $lumberjack, StoneMason $stoneMason)
    {
        $this->time = time();
        $this->res = new Res(0, 0);
        $this->constructionYard = $constructionYard;
        $this->lumberjack = $lumberjack;
        $this->stoneMason = $stoneMason;
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

    public function getRes(): Res {
        return $this->res;
    }

    public function update(int $millis): void
    {
        $event = $this->eventQueue->getNext();
        $now = $this->clock->getCurrentDate();
        $diff = $now->getMillis() - $event->getDate();
        if ($millis > $diff) {
            $event->fire();
        }
        // TODO
    }

    public function getLevel(string $building) {

    }

    public function isUpgrading(): bool
    {
        return false;
    }

    public function abortUpgrade(): void
    {

    }

}