<?php

require_once ('test1_cart_poo.php');

/*$cart = new Cart(0,100);
$cart->setTotalPrice(50);
$cart->pourcentage(5);

var_dump($cart);
$voiture = new Voiture("Bus","toyota",10000);
$voiture->setprice(15000);
$voiture->promotion(8);
//var_dump($voiture->getMarque());
var_dump($voiture);
*/

/*$voiture = new Voiture("Nissan","Bus",10000,"black");
$voiture->setPrice(15000);
$voiture->setGenre("Normale");
$voiture->setColore("Blue");
$voiture->solde(5.5);
var_dump($voiture);*/

$voiture = new Voiture ("Toyota","4x4","gris", 12000);
$voiture->setPrix(15000);
$voiture->solde(5.5);

//var_dump($voiture->getColore());
var_dump($voiture);