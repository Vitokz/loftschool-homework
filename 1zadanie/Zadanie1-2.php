<?php
define('ALL_PICTURES', 80);
define('PICT_MARKER', 23);
define('PICT_PENS', 40);
$pictPaints = ALL_PICTURES - PICT_MARKER - PICT_PENS;
echo("{$pictPaints}-рисунков нарисованных красками");

