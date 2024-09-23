<?php

namespace Idle\View;

use DiDom\Element;
use Idle\View\AbstractElementBuilder;

class Nav extends AbstractElementBuilder
{

    public function create(array $values, string $page): Element
    {
        $nav = new Element("nav");

        $a = new Element("a", $this->names["pages"]["overview"]);
        $a->setAttribute("class", "nav-button");
        $a->setAttribute("href", "?page=overview");
        $nav->appendChild($a);

        $a = new Element("a", $this->names["pages"]["buildings"]);
        $a->setAttribute("class", "nav-button");
        $a->setAttribute("href", "?page=overview");
        $nav->appendChild($a);

        return $nav;
    }
}
