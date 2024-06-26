<?php

require_once '../vendor/autoload.php';

use Idle\Logic\Logic;
use Idle\Login\AuthService;
use Idle\Persistence\Credentials;
use Idle\Persistence\Persistence;
use Idle\View\View;
use Kreait\Firebase\Factory;

$credentials = new Credentials();
$persistence = new Persistence($credentials);
$factory = (new Factory())->withServiceAccount('../config/idle-1f800-firebase-adminsdk-6elgd-2d5db3ec22.json');
$auth = $factory->createAuth();
$authService = new AuthService($auth, $persistence);
$logic = new Logic($persistence, $authService);
$names = parse_ini_file("../resources/names.ini", true);
$view = new View($names);

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $tokenId = $authService->login($email, $password);
}


$page = $_GET["page"] ?? "overview";
if (isset($_GET["up"])) {
    $logic->upgrade($_GET["up"]);
}

if (isset($_SESSION["idToken"])) {
    $values = $logic->get($_SESSION["idToken"]);
} else {

}

try {
    echo $view->create($values, $page);
} catch (Exception $e) {
    echo $e;
}
