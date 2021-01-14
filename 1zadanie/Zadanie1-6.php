<?php
echo "<table>";

echo "<tr><th> / </th>";
for ($i = 1; $i <= 10; $i++) {
    echo "<th>";
    echo "$i";
    echo "</th>";
}
echo "</tr>";

$stol6 = 1;
$line = 1;

echo "<tr><th> $line </th>";
for ($i = 1; $i <= 10; $i++) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 2; $i <= 20; $i += 2) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 3; $i <= 30; $i += 3) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 4; $i <= 40; $i += 4) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 5; $i <= 50; $i += 5) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 6; $i <= 60; $i += 6) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 7; $i <= 70; $i += 7) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 8; $i <= 80; $i += 8) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 9; $i <= 90; $i += 9) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

$stol6 = 1;
$line++;

echo "<tr><th> $line </th>";
for ($i = 10; $i <= 100; $i += 10) {
    echo"<td>";
    if (($line % 2 === 0) && ($stol6 % 2 === 0)) {
        echo "($i)";
    } elseif (($line % 2 != 0) && ($stol6 % 2 != 0)) {
        echo "[$i]";
    } else {
        echo "$i";
    }
    $stol6++;
    echo"</td>";
}
echo "</tr>";

echo "</table>";

