<?php
class StudentsTariff extends TarrifStandart
{
    public function __construct($kil, $min)
    {
        $this->kil = $kil;
        $this->min = $min;
        $this->minPrice=1;
        $this->kilPrice=4;
    }


}