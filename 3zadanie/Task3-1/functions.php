<?php

function generateName()
{
    $randomNameId = rand(1, 5);
    switch ($randomNameId) {
        case 1:
            return 'Sasha';
        case 2:
            return 'Geor';
        case 3:
            return 'Sos';
        case 4:
            return 'Vlad';
        case 5:
            return 'Diana';
    }
}

function countNames(array $array)
{
    foreach ($array as $key ) {
        do {
            if ($key['name'] === 'Sasha') {
                $countSasha++;
            } elseif ($key['name'] === 'Geor') {
                $countGeor++;
            } elseif ($key['name'] === 'Sos') {
                $countSos++;
            } elseif ($key['name'] === 'Vlad') {
                $countVlad++;
            } elseif ($key['name'] === 'Diana') {
                $countDiana++;
            }

    } while(!$array);
}
    return $array = [
        'Sasha'=>$countSasha,
        'Geor'=>$countGeor,
        'Sos'=>$countSos,
        'Vlad'=>$countVlad,
        'Diana'=>$countDiana
    ];
}

function getMiddleAge(array $array)
{
    foreach($array as $key) {
        $sum+=$key['age'];
    }
    return $sum / 50;
}