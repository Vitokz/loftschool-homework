<?php
include "source/класс-обертка.php";
include 'source/class_Burgers.php';
ini_set('display_errors' , 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);
$burger = new Burgers();

$email = $_POST['email'];

$adressFields=[
    'street',
    'home',
    'part',
    'appt' ,
    'floor'
    ];
$address='';
foreach ($_POST as $fields => $value) {
    if ($value && in_array($fields, $adressFields)) {
        $address .= $value . ' ';
    }
}


$user = $burger->checkUsersEmail($email);

if ($user) {
    $userID = $user['id'];
    $burger->incOrders($user['id']);
    $orderNumber = $user['countOrders'] + 1;
} else {
    $orderNumber= 1;
    $userID = $burger->createUser($email);
}

$orderID = $burger->addOrder($userID,$address);

echo "Спасибо, ваш заказ будет доставлен по адресу:" . $address  . '<br>';
echo "Номер вашего заказа:" . $orderID . '<br>';
echo "Это ваш " . $orderNumber .  ' заказ' . '<br>';


