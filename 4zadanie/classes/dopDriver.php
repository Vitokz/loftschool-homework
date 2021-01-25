<?php
class dopDriver implements ServiceINTER
{

public function apply($tarrif, $price)
{

return $price + 100;
}
}