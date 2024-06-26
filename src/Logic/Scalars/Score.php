<?php

namespace Idle\Logic\Scalars;

class Score
{

    private readonly int $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
