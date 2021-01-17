<?php
file_put_contents('text.txt', 'Hello again!');

function addFile($fileName)
{
    $fp = fopen($fileName, 'r');
    if(!$fp) {
        return false;
    }

    while(feof($fp) === false) {
        $str .= fgets($fp, 1024);
    }
    echo $str;
}

addFile('text.txt');