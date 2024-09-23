<?php

namespace Idle\Logic;

use InvalidArgumentException;

enum BuildingType
{
    case CONSTRUCTION_YARD;
    case LUMBER_JACK;
    case STONE_MASON;
    case WARE_HOUSE;

    public static function valueOf(string $string): BuildingType
    {
        return match (strtolower($string)) {
            "lumberjack" => self::LUMBER_JACK,
            "stonemason" => self::STONE_MASON,
            default => throw new InvalidArgumentException()
        };
    }
}
