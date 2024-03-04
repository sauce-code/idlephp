<?php

require_once '../vendor/autoload.php';

use Idle\Logic\Logic;
use Idle\View\View;

$logic = new Logic();
$view = new View($logic);

echo $view->asHTML();
