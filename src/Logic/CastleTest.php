<?php

namespace Idle\Logic;

use PHPUnit\Framework\TestCase;

class CastleTest extends TestCase
{

    public function testFoo()
    {
        $castle = new Castle();
        $expected = $castle->foo();
        $this->assertEquals("bar", $expected);
    }

}
