<?php
echo "<table>";

echo "<tr><th> / </th>";
for ($i = 1; $i <= 10; $i++) {
    echo "<th>";
    echo "$i";
    echo "</th>";
}
echo "</tr>";
$stol6=1;
$sn=1;
$en=10;
$j=$sn;
for($line=1;$line<=10;$line++) {
    echo "<tr><th> $line </th>";
    $sn=$line;
    $j=$line;
    for (;$sn <= $en; $sn+=$j) {
        echo"<td>";
        if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
            echo "($sn)";
        } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
            echo "[$sn]";
        } else {
            echo "$sn";
        }
        echo"</td>";
        $stol6++;
    }
    $en+=10;
    $stol6=1;
    echo "</tr>";
}
