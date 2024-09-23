<?php

namespace Idle\Persistence;

use Idle\Logic\Buildings\LumberJack;
use Idle\Logic\Buildings\StoneMason;
use Idle\Logic\BuildingType;
use Idle\Logic\Castle;
use Idle\Logic\Player;
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

    private function connect(): mysqli
    {
        $hostname = $this->credentials->getHostname();
        $username = $this->credentials->getUsername();
        $password = $this->credentials->getPassword();
        $database = $this->credentials->getDatabase();
        $conn = new mysqli($hostname, $username, $password, $database);

        if ($conn->connect_error) {
            throw new PersistenceException($conn->connect_error);
        }

        return $conn;
    }

    public function readCastle(): ?Castle
    {
        $conn = $this->connect();

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
        $conn = $this->connect();

        $time = $castle->getTime()->getMillis();
        $lumber = $castle->getRes()->getLumber();
        $stone = $castle->getRes()->getStone();
        $lumberJack = $castle->getLevel(BuildingType::LUMBER_JACK);
        $stoneMason = $castle->getLevel(BuildingType::STONE_MASON);
        $id = 1;
        $prep = $conn->prepare("UPDATE `Castle` SET `date` = ?,
                    `lumber` = ?, `stone` = ?, `lumberjack` = ?, `stonemason` = ? WHERE `Castle`.`ID` = ?");
        $prep->bind_param("iiiiii", $time, $lumber, $stone, $lumberJack, $stoneMason, $id);

        $prep->execute();
        $conn->close();
    }

    public function redeem(string $code): bool
    {
        $conn = $this->connect();

        $prep = $conn->prepare("SELECT `id`, `code` FROM `Invitation` WHERE `code` = ?");
        $prep->bind_param("s", $code);
        $prep->execute();
        $result = $prep->get_result();

        if ($result->num_rows == 0) {
            $conn->close();
            return false;
        }

        $prep = $conn->prepare("DELETE FROM `Invitation` WHERE `code` = ?");
        $prep->bind_param("s", $code);
        $prep->execute();
        $conn->close();

        return true;
    }

    public function getPlayer(string $uuid): Player
    {
        $conn = $this->connect();

        $prep = $conn->prepare("SELECT `ID`, `Name` FROM `Player` WHERE `UUID` = ?");
        $prep->bind_param("s", $uuid);
        $prep->execute();
        $result = $prep->get_result();
        $row = $result->fetch_assoc();
        return new Player(
            $row["id"],
            $row["name"]
        );
    }

    public function createPlayer(string $uuid, $name): bool
    {
        $conn = $this->connect();
        $prep = $conn->prepare("INSERT INTO `Player` (`UUID`, `Name`) VALUES (?, ?)");
        $prep->bind_param("ss", $uuid, $name);
        $prep->execute();
        $conn->close();
        return true;
    }

    public function updatePlayer(Player $player): bool
    {
        $conn = $this->connect();
        $id = $player->getId();
        $prep = $conn->prepare("UPDATE `Player` SET `name` = ? WHERE `Player`.`ID` = ?");
        $prep->bind_param("i", $id);
        $prep->execute();
        $conn->close();
        return true; // TODO
    }
}
