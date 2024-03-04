<?php

namespace Idle\View;

use DOMDocument;
use Idle\Logic\Logic;

class View
{
    private readonly Logic $logic;

    public function __construct(Logic $logic)
    {
        $this->logic = $logic;
    }

    public function asHTML(): string
    {
        $doc = new DOMDocument();
        $doc->loadHTMLFile("template.html");

        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        return $doc->saveHTML();
    }
}
