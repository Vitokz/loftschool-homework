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
    $evenLine = $line % 2 === 0;
    echo "<tr><th> $line </th>";
    for ($column = 1; $column <= 10; $column++) {
        $evenColumn = $column % 2 === 0;
        echo "<td>";
        if (($evenLine === true) && ($evenColumn === true)) {
            echo "(" . $column * $line . ")";
        } elseif (($evenLine != true) && ($evenColumn != true)) {
            echo "[" . $column * $line . "]";
        } else {
            echo $column * $line;
        }
        echo "</td>";

    }

    echo "</tr>";
}
