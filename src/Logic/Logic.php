<?php

namespace Idle\Logic;

use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Persistence\Persistence;

class Logic
{
    private readonly Persistence $persistence;

    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }

    public function get(): array
    {
        $castle = $this->persistence->readCastle();
        $castle->update();
        return array(
            "lumberjack" => array(
                "level" => $castle->getLevel(LumberJack::class),
                "cost" => array(
                    "lumber" => $castle->getCost(LumberJack::class)->getLumber(),
                    "stone" => $castle->getCost(LumberJack::class)->getLumber()
                )
            ),
            "stonemason" => array(
                "level" => $castle->getLevel(StoneMason::class),
                "cost" => array(
                    "lumber" => $castle->getCost(StoneMason::class)->getLumber(),
                    "stone" => $castle->getCost(StoneMason::class)->getLumber()
                )
            ),
            "res" => array(
                "lumber" => $castle->getRes()->getLumber(),
                "stone" => $castle->getRes()->getStone()
            )
        );
    }

    public function upgrade(string $building): array
    {
        $castle = $this->persistence->readCastle();
        $castle->update();
        $castle->upgrade($building);
        return array(
            "lumberjack" => $castle->getLevel("lumberjack"),
            "stonemason" => $castle->getLevel("stonemason"),
            "lumber" => $castle->getRes()->getLumber(),
            "stone" => $castle->getRes()->getStone()
        );
    }
}
