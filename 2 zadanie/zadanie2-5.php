<?php
$string = 'Карл у Клары украл Кораллы';
$stringArray = explode(' ', $string); //создаем массив из этой строки
foreach ($stringArray as $key => $str) {
    $idK = mb_strpos($str, 'К'); //Вычисляем под каким номером находится нужная буква
    if ($idK === 0) {
        $stringArray[$key] = mb_substr($str, $idK + 1); //Удаляем букву К,если она первая в списке
    } elseif (isset($idK)) {
        $stringArray[$key] = mb_substr($str, 0, $idK) . mb_substr($str, $idK + 1); //Удаляем букву К , если она не на первом месте
    }
}

$stringArray = implode(' ', $stringArray); //Соединяем масиив

echo $stringArray;


