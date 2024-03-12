<?php

require_once '../vendor/autoload.php';

use Idle\Logic\Logic;
use Idle\Persistence\Credentials;
use Idle\Persistence\Persistence;
use Idle\View\View;

$credentials = new Credentials();
$persistence = new Persistence($credentials);
$logic = new Logic($persistence);
$names = parse_ini_file("../resources/names.ini", true);
$view = new View($logic, $names);

$page = $_GET["page"] ?? "buildings";

echo $view->create($page);
