<?php
class GPS implements ServiceINTER
{

public function apply($tarrif, &$price)
{
$hours = ceil($tarrif->getMinutes() / 60);
$price = $price + $hours*15;
}
}