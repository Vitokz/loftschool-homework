<?php
//Создание массива пользователей
function generateRandomUsers(int $countUsers, array $user_names)
{
    $users = [];
    for ($i = 1; $i <= $countUsers; $i++) { //создем массив

        $users ["User{$i}"]= [  //заполняем массив
            'id' => $i,
            'name' => $user_names[array_rand($user_names)],
            'age' => rand(18, 45)
        ];
    }
    return $users;
}

//Вычисление количества пользователей с одинаковыми именами
function countNames( array $users)
{
    $arrayNames= function ($users)
    {
        return $users['name'];
    };
   return array_count_values(array_map($arrayNames, $users));
}

// Вычисление среднего возраста
function getMiddleAge(array $array)
{
    foreach($array as $key) {
        $sum+=$key['age'];
    }
    return $sum / 50;
}

