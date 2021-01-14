<?php
$bmw = [];
$bmw['model'] = 'X5';
$bmw['speed'] = '120';
$bmw['doors'] = '5';
$bmw['year'] = '2015';

$toyota = [];
$toyota ['model'] = 'Camry';
$toyota ['speed'] = '140';
$toyota ['doors'] = '5';
$toyota ['year'] = '2020';

$opel = [];
$opel ['model'] = 'Astra gt';
$opel ['speed'] = '100';
$opel ['doors'] = '3';
$opel ['year'] = '2008';

$machines = ['bmw' => [$bmw['model'], $bmw['speed'], $bmw['doors'], $bmw['year']], 'toyota' => [$toyota ['model'], $toyota ['speed'], $toyota ['doors'], $toyota ['year']], 'opel' => [$opel ['model'], $opel ['speed'], $opel ['doors'], $opel ['year']]];
echo("CAR bmw");
echo("\n");
 for ($i = 0; $i < 4; $i++) {
    echo($machines['bmw'][$i] . ' ');
}

echo("\n");

echo("CAR toyota");
echo("\n");
for ($i = 0; $i < 4; $i++) {
    echo($machines['toyota'][$i] . ' ');
}

echo("\n");

echo("CAR opel");
echo("\n");
for ($i = 0; $i < 4; $i++) {
    echo($machines['opel'][$i] . ' ');
}


