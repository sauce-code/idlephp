<?php
require_once("src/View/Window.php");
require_once("src/View/Body.php");

use Idle\View\Body;
use Idle\View\Window;

$body = new Body();
$window = new Window($body);
echo($window->convert());
