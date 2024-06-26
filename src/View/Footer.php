<?php

namespace Idle\View;

use DiDom\Element;

class Footer extends AbstractElementBuilder
{

    public function create(array $values, string $page): Element
    {
        $footer = new Element("footer");
        $p = new Element("p");
        $p->setValue("Game Time: " . time());
        $footer->appendChild($p);
        return $footer;
    }
}
