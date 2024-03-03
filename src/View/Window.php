<?php

namespace Idle\View;

class Window
{
    private Body $body;

    public function __construct(Body $body)
    {
        $this->body = $body;
    }

    public function convert(): string
    {
        $s = '<html lang="DE-de">';
        $s .= '<head><title>idle</title></head>';
        $s .= $this->body->convert();
        $s .= '</html>';
        return $s;
    }
}
