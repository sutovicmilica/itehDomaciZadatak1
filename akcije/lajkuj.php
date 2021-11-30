<?php
include '../sesija.php';
include '../baza/Broker.php';

$dbBroker = new Broker();

$outfitID = $_POST['outfitID'];


$dbBroker->lajkuj($outfitID, $_SESSION['korisnik']['korisnikID']);