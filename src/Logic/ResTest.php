<?php

namespace Idle\Logic;

use PHPUnit\Framework\TestCase;

class ResTest extends TestCase
{
    public function testGetLumber()
    {
        $res = new Res(1, 2);
        $this->assertEquals(1, $res->getLumber());
    }

    public function testGetStone()
    {
        $res = new Res(1, 2);
        $this->assertEquals(2, $res->getStone());
    }

    public function testAdd()
    {
        $res1 = new Res(1, 2);
        $res2 = new Res(3, 4);
        $actual = $res1->add($res2);
        $expected = new Res(4, 6);
        $this->assertEquals($expected, $actual);
    }
}
