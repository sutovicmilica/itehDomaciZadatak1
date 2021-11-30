<?php
include '../sesija.php';
include '../baza/Broker.php';

$dbBroker = new Broker();

if($dbBroker->registracija($_POST['ime'],$_POST['prezime'],$_POST['username'], $_POST['password'])){
    echo "Korisnik je uspesno registrovan";
}else{
    echo "Korisnik nije registrovan. Username je vec zauzet.";
}