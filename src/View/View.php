<?php

namespace Idle\View;

use DiDom\Document;
use DiDom\Element;

class View
{

    protected readonly array $names;

    public function __construct(array $names)
    {
        $this->names = $names;
    }

    public function create(array $values, string $page): string
    {
        $doc = new Document("template.html", true);

        $header = $doc->first("header");
        $builder = new Header($this->names);
        $header->replace($builder->create($values, $page));

        $nav = $doc->first("nav");
        $builder = new Nav($this->names);
        $nav->replace($builder->create($values, $page));

        $main = $doc->first("main");
        $builder = new Main($this->names);
        $main->replace($builder->create($values, $page));

        $footer = $doc->first("footer");
        $builder = new Footer($this->names);
        $footer->replace($builder->create($values, $page));

        return $doc->html();
    }
}
