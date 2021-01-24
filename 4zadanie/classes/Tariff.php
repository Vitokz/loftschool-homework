<?php
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