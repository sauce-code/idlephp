<?php

namespace Idle\Logic\Scalars;

use PHPUnit\Framework\TestCase;

class IDTest extends TestCase
{

    public function test__construct()
    {
        $this->expectException("InvalidArgumentException");
        new ID(-1);
    }

    public function testGetValue()
    {
        $id = new ID(0);
        self::assertEquals(0, $id->getValue());
    }
}
