<?php
include 'functions.php';
echo '<pre>';
$user_names = require('usersName.php');
//var_dump($user_names);

//создаем пользователей
$users = generateRandomUsers(50,$user_names);
//var_dump($users);

//Преобразовываем массив $users в Json формат
$json=json_encode($users);
file_put_contents('users.json', $json);


//разкодировать Json-файл в массив
$arrayJson=json_decode(file_get_contents('users.json'), true);
//var_export($arrayJson);

//Считаем количество имен
$countNames=countNames($arrayJson);
var_export($countNames);

echo '<br>';

//Считаем средний восзраст
$middleAge=getMiddleAge($arrayJson);
//var_export("Средний возраст :{$middleAge}");



