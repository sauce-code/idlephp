<?php

namespace Idle\Logic;

use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Login\AuthService;
use Idle\Persistence\Persistence;

class Logic
{
    private readonly Persistence $persistence;

    private readonly AuthService $authService;

    public function __construct(Persistence $persistence, AuthService $authService)
    {
        $this->persistence = $persistence;
        $this->authService = $authService;
    }

    public function get(string $idToken): array
    {
        $uuid = $this->authService->verify($idToken);

        $castle = $this->persistence->readCastle();
        $castle->update();
        return array(
            "buildings" => array(
                0 => "lumberjack",
                1 => "stonemason"
            ),
            "lumberjack" => array(
                "level" => $castle->getLevel(BuildingType::LUMBER_JACK),
                "cost" => array(
                    "lumber" => $castle->getCost(BuildingType::LUMBER_JACK)->getLumber(),
                    "stone" => $castle->getCost(BuildingType::LUMBER_JACK)->getLumber()
                )
            ),
            "stonemason" => array(
                "level" => $castle->getLevel(BuildingType::STONE_MASON),
                "cost" => array(
                    "lumber" => $castle->getCost(BuildingType::STONE_MASON)->getLumber(),
                    "stone" => $castle->getCost(BuildingType::STONE_MASON)->getLumber()
                )
            ),
            "res" => array(
                "lumber" => $castle->getRes()->getLumber(),
                "stone" => $castle->getRes()->getStone()
            ),
            "income" => array(
                "lumber" => $castle->getIncome()->getLumber(),
                "stone" => $castle->getIncome()->getStone()
            )
        );
    }

    public function upgrade(string $building): void
    {
        $castle = $this->persistence->readCastle();
        $castle->update();
        $buildingType = BuildingType::valueOf($building);
        $castle->upgrade($buildingType);
        $this->persistence->writeCastle($castle);
    }
}
