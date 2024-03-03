<?php

namespace Idle\Logic;

class Res
{

    private int $lumber;
    private int $stone;

    public function __construct(int $lumber, int $stone)
    {
        $this->lumber = $lumber;
        $this->stone = $stone;
    }

    public function getLumber(): int
    {
        return $this->lumber;
    }

    public function getStone(): int
    {
        return $this->stone;
    }

    public function add(Res $other): Res
    {
        return new Res(
            $this->lumber + $other->lumber,
            $this->stone + $other->stone
        );
    }
}
