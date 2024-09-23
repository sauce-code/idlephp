<?php

namespace Idle\Logic\Scalars;

use InvalidArgumentException;

class Name
{

    const MIN_LENGTH = 1;

    const MAX_LENGTH = 12;

    private readonly string $value;

    public function __construct(string $value)
    {
        $char = mb_substr($value, 0, 1);
        if (mb_strtolower($char) == $char) {
            throw new InvalidArgumentException();
        }
        if (strlen($value) < self::MIN_LENGTH) {
            throw new InvalidArgumentException();
        }
        if (strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException();
        }
        if (str_contains($value, " ")) {
            throw new InvalidArgumentException();
        }
        if (!ctype_alpha($value)) {
            throw new InvalidArgumentException();
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
