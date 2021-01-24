<?php
interface TariffINTER
{
    public function kilPrice($price);

    public function minPrice($price);

    public function calculatePrice();

    public function addService(ServiceINTER $service);
}