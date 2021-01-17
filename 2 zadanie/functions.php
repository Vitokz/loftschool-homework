<?php
function task1(array $arrayString, $version = false)
{
    $result = '';

    foreach ($arrayString as $key => $value) {
        $result .= '<p>' . $value . '</p>';
    }

    if ($version === true) {
        return $result;
    } else {
        echo $result;
    }
}

function task2(string $operation, ...$arqs)
{
    //Проверка на целые и вещественные
    for ($i = 0; $i < sizeof($arqs); $i++) {
        if ((is_int($arqs[$i]) === false) && (is_float($arqs[$i]) === false)) {
            return 'одно из значений не является числом';
        }
    }
    $result = array_shift($arqs);
    for($i = 0; $i < sizeof($arqs); $i++) {
            if ($operation === '+') {
                $result += $arqs[$i];
            } elseif ($operation === '-') {
                $result -= $arqs[$i];
            } elseif ($operation === '*') {
                $result *= $arqs[$i];
            } elseif ($operation === '/') {
                if ($arqs[$i] !== 0) {
                    $result /= $arqs[$i];
                } else {
                    return 'одно из значений = 0 ,делить на ноль нельзя';
                }
            }
    }
    return $result;
}

function task3(int $n1, int $n2)
{
    echo '<pre>';
    echo '<table>';
    for ($line = 1; $line <= $n2; $line++) {
        echo '<tr>';
        for ($column = 1; $column <= $n2; $column++) {
            echo '<td>';
            echo "{$column} * {$line} = " . $column * $line;
            echo '</td> ';

        }

        echo '</tr>';
    }
    echo '</table>';
    echo '</pre>';
}

