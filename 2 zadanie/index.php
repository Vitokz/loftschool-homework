<?php
require 'functions.php';

$string = [
    'Bmw',
    'Mercedes-Benz',
    'Opel',
    'Volkswagen',
    'Toyota',
    'Honda',
    'Hyundai',
];
echo task1($string, false);

echo task2('+', 2, 3, 4, 5, 6);
echo task2('-', 2, 3, 4, 5, 6);
echo task2('*', 2, 3, 4, 5, 6);
echo task2('/', 2, 3, 4, 5, 6);

task3(6, 6);