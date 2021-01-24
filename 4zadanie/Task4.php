<?php
include 'classService.php';


/** @var serviceINTER $tariff */
$basic= new hoursTariff(5,60);
//$basic->addService(new GPS());
//$basic->addService(new dopDriver());
echo $basic->calculatePrice();

