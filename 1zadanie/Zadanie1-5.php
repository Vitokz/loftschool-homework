<?php
$bmw = [
    'model' => 'X5',
    'speed' => 120,
    'doors' => 5,
    'year' => 2015,
];

$toyota = [
    'model' => 'Camry',
    'speed' => 140,
    'doors' => 5,
    'year' => 2020,
];

$opel = [
    'model' => 'Astra gt',
    'speed' => 100,
    'doors' => 3,
    'year' => 2008,
];

$machines = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];
foreach ($machines as $idMark => $mark) {
    echo("CAR {$idMark}");
    echo("\n");
    foreach ($mark as $property => $value) {
        echo($value . ' ');
    }
    echo("\n");
}
