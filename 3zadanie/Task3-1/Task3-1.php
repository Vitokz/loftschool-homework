<?php
include "functions.php";
echo '<pre>';

$users = [];
for ($i = 1; $i <= 50; $i++) { //создем массив
    $users += ["User{$i}" => [  //заполняем массив
        'id' => $i,
        'name' => generateName(),
        'age' => rand(18, 45)
    ],
    ];
}

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
var_export("Средний возраст :{$middleAge}");



