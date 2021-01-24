<?php

interface TariffINTER
{
    public function kilPrice($price);

    public function minPrice($price);

    public function calculatePrice();

    public function addService(ServiceINTER $service);
}

interface ServiceINTER
{
    public function apply($tarrif, &$price);

}

abstract class TarrifStandart implements TariffINTER
{
    protected $kilPrice;
    protected $minPrice;
    protected $kil;
    protected $min;
    /** @var ServiceINTER[] */
    protected $services= [];

    public function __construct($kil, $min)
    {
        $this->kil = $kil;
        $this->min = $min;
    }

    public function getMinutes() {
         return $this->min;
    }

    public function getKil() {
        return $this->kil;
    }

    public function minPrice($price)
    {
        $this->minPrice = $price;
    }

    public function kilPrice($price)
    {
        $this->kilPrice = $price;
    }

    public function calculatePrice()
    {
        $price = ($this->kil * $this->kilPrice) + ($this->min * $this->minPrice);
        if ($this->services) {
            foreach ($this->services as $service) {
                $service->apply($this, $price);
            }

        }
        return $price;
    }

    public function addService($service)
    {
        array_push($this->services, $service);
        return $this;
    }
}

class GPS implements ServiceINTER
{

    public function apply($tarrif, &$price)
    {
        $hours = ceil($tarrif->getMinutes() / 60);
        $price = $price + $hours*15;
    }
}

class dopDriver implements ServiceINTER
{

    public function apply($tarrif, &$price)
    {

        $price = $price + 100;
    }
}

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