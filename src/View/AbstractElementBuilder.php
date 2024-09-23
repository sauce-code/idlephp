<?php

namespace Idle\View;

use DiDom\Element;

abstract class AbstractElementBuilder
{
    protected readonly array $names;

    public function __construct(array $names)
    {
        $this->names = $names;
    }

    abstract public function create(array $values, string $page): Element;
}
