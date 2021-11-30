<?php
include '../sesija.php';
include '../baza/Broker.php';

$dbBroker = new Broker();

$sortiranje = $_POST['sortiranje'];
$pretraga = $_POST['pretraga'];

$rezultati = $dbBroker->pretrazi($pretraga, $sortiranje);

foreach ($rezultati as $rezultat){

?>

<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
    <div class="block2">
        <div class="block2-pic hov-img0">
            <img src="images/<?= $rezultat->slika ?>" alt="IMG-PRODUCT">
        </div>

        <div class="block2-txt flex-w flex-t p-t-14">
            <div class="block2-txt-child1 flex-col-l ">
                <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    <?= $rezultat->naziv ?>
                </a>

                <span class="stext-105 cl3">
                    <?= $rezultat->opis ?>
                </span>
                <span class="stext-105 cl3">
                   Korisnik: <?= $rezultat->ime . " " . $rezultat->prezime ?>
                </span>
                <span class="stext-105 cl3">
                   Svidja se : <?= $rezultat->brojSvidjanja?> osoba
                </span>
                <?php

                    if($_SESSION['login'] === true && !$dbBroker->proveriDaLiJeVecLajkovano($rezultat->outfitID, $_SESSION['korisnik']['korisnikID'])){
                        ?>
                            <div class="pull-right" style="padding-top: 20px">
                                <input type="image" src="images/icons/icon-heart-01.png" alt="ICON" onmouseover="this.src='images/icons/icon-heart-02.png'"
                                       onmouseout="this.src='images/icons/icon-heart-01.png'"
                                       onclick="lajkuj(<?= $rezultat->outfitID ?>)" class="form-control">
                            </div>
                        <?php
                    }
                ?>
            </div>


        </div>
    </div>
</div>
<?php
}
?>