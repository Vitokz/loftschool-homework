<?php
echo "<table>";

echo "<tr><th> / </th>";
for ($i = 1; $i <= 10; $i++) {
    echo "<th>";
    echo "$i";
    echo "</th>";
}
echo "</tr>";

for ($line = 1; $line <= 10; $line++) {
    echo "<tr><th> $line </th>";
    for ($column = 1; $column <= 10; $column++) {
        echo "<td>";
        if (($line % 2 === 0) && ($column % 2 === 0)) {
            echo "(" . $column*$line .")";
        } elseif (($line % 2 != 0) && ($column % 2 != 0)) {
            echo "[" . $column*$line ."]";
        } else {
            echo $column*$line ;
        }
        echo "</td>";

    }

    echo "</tr>";
}
