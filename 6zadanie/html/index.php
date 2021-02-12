<?php

use Src\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '..\src\config.php';
include'..\vendor\autoload.php';
require_once '..\database\SQLhost.php';
 $db= new \App\Model\Database();
$app=new Application();
$app->run();