<?php
$fp = fopen("text.txt", 'w');
fputs($fp, 'Hello again!');
fclose($fp);

function addFile($fileName)
{
    $fp = fopen($fileName, 'r');
    $str = fgets( $fp, 1024);
    echo $str;
}

addFile('text.txt');