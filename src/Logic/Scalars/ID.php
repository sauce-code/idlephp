<?php

namespace Idle\Logic\Scalars;

use InvalidArgumentException;

class ID
{

    private readonly int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException();
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
