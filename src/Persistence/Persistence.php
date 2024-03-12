<?php

namespace Idle\Persistence;

use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Logic\Castle;
use Idle\Logic\Res;
use Idle\Logic\Time\Clock;
use Idle\Logic\Time\Time;
use mysqli;

class Persistence
{
    private readonly Credentials $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function readCastle(): ?Castle
    {
        $hostname = $this->credentials->getHostname();
        $username = $this->credentials->getUsername();
        $password = $this->credentials->getPassword();
        $database = $this->credentials->getDatabase();
        $conn = new mysqli($hostname, $username, $password, $database);

        if ($conn->connect_error) {
            throw new PersistenceException($conn->connect_error);
        }

        $sql = "SELECT `ID`, `date`, `lumber`, `stone`, `lumberjack`, `stonemason` FROM `Castle` WHERE PlayerID = 2";
        $result = $conn->query($sql);
        $conn->close();

        if ($result->num_rows != 1) {
            throw new PersistenceException();
        }

        $row = $result->fetch_assoc();
        $time = new Time($row["date"]);
        $res = new Res($row["lumber"], $row["stone"]);
        $lumberJack = new LumberJack($row["lumberjack"]);
        $stoneMason = new StoneMason($row["stonemason"]);
        $clock = new Clock();
        return new Castle($time, $res, $lumberJack, $stoneMason, $clock);
    }

    public function writeCastle(Castle $castle): void
    {
        throw  new PersistenceException("not yet implemented");
    }
}
