<?php
class hoursTariff extends TarrifStandart
{
    public function __construct($kil, $min)
    {
        $this->kil = $kil;
        $this->min = $min;
        $this->minPrice=200/60;
        $this->kilPrice=0;

        if($this->min) {
            $rest=$this->min %60;
            $this->min = $this->min - $rest + 60;
        }

    }
}