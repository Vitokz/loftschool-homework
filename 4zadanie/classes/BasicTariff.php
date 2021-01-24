<?php
class BasicTariff extends TarrifStandart
{
    public function __construct($kil, $min)
    {
        $this->kil = $kil;
        $this->min = $min;
        $this->minPrice=3;
        $this->kilPrice=10;
    }


}