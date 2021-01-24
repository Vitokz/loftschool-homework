<?php
class dopDriver implements ServiceINTER
{

public function apply($tarrif, &$price)
{

$price = $price + 100;
}
}