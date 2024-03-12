<?php

namespace Idle\Persistence;

use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Logic\Castle;
use Idle\Logic\Res;
use Idle\Logic\Time\Clock;
use Idle\Logic\Time\Time;
use PHPUnit\Framework\TestCase;

class PersistenceTest extends TestCase
{

    public function testReadCastle()
    {
        $credentials = new Credentials();
        $persistence = new Persistence($credentials);
        $actual = $persistence->readCastle();
        $expected = new Castle(
            new Time(123),
            new Res(2, 4),
            new LumberJack(1),
            new StoneMason(1),
            new Clock()
        );
        $this->assertEquals($expected, $actual);
    }
}
