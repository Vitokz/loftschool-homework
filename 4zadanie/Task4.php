<?php
include 'classes/TariffINTER.php';
include 'classes/ServiceINTER.php';
include 'classes/GPS.php';
include 'classes/dopDriver.php';
include 'classes/Tariff.php';
include 'classes/BasicTariff.php';
include 'classes/hoursTariff.php';
include 'classes/StudentsTariff.php';



/** @var serviceINTER $tariff */
$basic= new hoursTariff(5,60);
//$basic->addService(new GPS());
//$basic->addService(new dopDriver());
echo $basic->calculatePrice();

