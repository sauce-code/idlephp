<?php

namespace Idle\Logic;

class Res
{

    private readonly int $lumber;
    private readonly int $stone;

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

    public function subtract(Res $other): Res
    {
        return new Res(
            $this->lumber - $other->lumber,
            $this->stone - $other->stone
        );
    }

    public function has(Res $other): bool
    {
        return $this->lumber >= $other->lumber
            && $this->stone >= $other->stone;
    }
}
