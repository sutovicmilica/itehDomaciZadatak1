<?php
include '../sesija.php';
include '../baza/Broker.php';

$dbBroker = new Broker();

$ulogovan = $dbBroker->login($_POST['username'], $_POST['password']);

if($ulogovan){
    echo "Korisnik uspesno ulogovan";
}else{
    echo "Korisnik nije ulogovan. Proverite podatke koje ste uneli";
}