<?php

use Src\Application;


include '..\src\config.php';
include'..\vendor\autoload.php';

$app=new Application();
$app->run();