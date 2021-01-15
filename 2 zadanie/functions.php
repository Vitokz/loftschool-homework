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
    $result = 0;
    if ($operation === '+' || $operation === '-') {
        if ($operation === '+') {
            for ($i = 0; $i < sizeof($arqs); $i++) {
                $result += $arqs[$i];
            }
        } else {
            for ($i = 0; $i < sizeof($arqs); $i++) {
                $result -= $arqs[$i];
            }
        }
    }
    if ($operation === '*') {
        $result = 1;
        for ($i = 0; $i < sizeof($arqs); $i++) {
            $result *= $arqs[$i];
        }
    }
    if ($operation === '/') {
        $result = $arqs[0];
        for ($i = 1; $i < sizeof($arqs); $i++) {
            $result /= $arqs[$i];
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

