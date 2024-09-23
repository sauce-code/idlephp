<?php

namespace Idle\Logic\Scalars;

use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{

    public function test__construct()
    {
        $this->expectException("InvalidArgumentException");
        new Name("invalid name");
    }

    public function testGetValue()
    {
        $name = new Name("John");
        self::assertEquals("John", $name->getValue());
    }
}
