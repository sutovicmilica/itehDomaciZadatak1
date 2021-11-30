<?php

require 'sesija.php';
include "baza/Broker.php";
$poruka = "";
$dbBroker = new Broker();

if(isset($_POST['submit'])){
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["slika"]["name"]);
    $slika = basename($_FILES["slika"]["name"]);

    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
        if($dbBroker->unosOutfita($_POST['naziv'], $_POST['opis'], $slika, $_SESSION['korisnik']['korisnikID'])){
            $poruka = "Uspesno dodat outfit";
        }else{
            $poruka = "Doslo je do greske u unosu outfita";
        }
    } else {
        $poruka = "Doslo je do greske. Pokusajte kasnije";
    }
}
if(isset($_POST['izmena'])){
    $outfitID = $_POST['outfitIzmena'];
    $naziv = $_POST['nazivIzmena'];
    $opis = $_POST['opisIzmena'];

    if($dbBroker->izmeni($outfitID, $naziv, $opis)){
        $poruka = "Uspesno izmenjen outfit";
    }else{
        $poruka = "Doslo je do greske pri izmeni outfita";
    }
}

if(isset($_POST['brisanje'])){
    $outfitID = $_POST['outfitBrisanje'];

    if($dbBroker->obrisi($outfitID)){
        $poruka = "Uspesno obrisan outfit";
    }else{
        $poruka = "Doslo je do greske pri brisanju outfita";
    }
}


$outfitiKorisnika = $dbBroker->vratiOutfiteZaKorisnika($_SESSION['korisnik']['korisnikID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Outfit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="animsition">
	
	<?php
    include 'header.php';
    ?>

	<section class="bg0 p-t-23 p-b-140" style="padding-top: 160px;">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Administracija outfita korisnika <?php echo $_SESSION['korisnik']['ime'] . " " . $_SESSION['korisnik']['prezime']?>
				</h3>
                <p id="details"> <?= $poruka ?></p>
            </div>

            <h4>Dodavanje novog outfita</h4>
            <div class="row">
                <div class="col-12">
                    <form method="post" action="" enctype="multipart/form-data">
                        <label for="naziv">Naziv</label>
                        <input type="text" name="naziv" class="form-control">
                        <label for="opis">Opis</label>
                        <input type="text" name="opis" class="form-control">
                        <label for="slika">Slika</label>
                        <input type="file" name="slika" class="form-control">
                        <br/><br/>
                        <input type="submit" class="btn btn-dark" value="Unesi outfit" name="submit">
                    </form>

                </div>
            </div>
<br/>
            <div class="row">
                <div class="col-6">
                    <h4>Obrisi outfit</h4>
                    <form method="post" action="">
                        <label for="outfitBrisanje">Outfit</label>
                        <select name="outfitBrisanje" class="form-control">
                            <?php
                            foreach ($outfitiKorisnika as $outfit) {
                                ?>
                                <option value="<?= $outfit->outfitID ?>"><?= $outfit->naziv ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <br/><br/>
                        <input type="submit" name="brisanje" value="Obrisi" class="btn btn-dark">
                    </form>

                </div>

                <div class="col-6">
                    <h4>Izmeni outfit</h4>
                    <form method="post" action="">
                        <label for="outfitIzmena">Outfit</label>
                        <select name="outfitIzmena" class="form-control">
                            <?php
                            foreach ($outfitiKorisnika as $outfit) {
                                ?>
                                <option value="<?= $outfit->outfitID ?>"><?= $outfit->naziv ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label for="nazivIzmena">Naziv</label>
                        <input type="text" name="nazivIzmena" class="form-control">
                        <label for="opisIzmena">Opis</label>
                        <input type="text" name="opisIzmena" class="form-control">
                        <br/><br/>
                        <input type="submit" name="izmena" value="Izmeni" class="btn btn-dark">
                    </form>

                </div>
            </div>
		</div>
	</section>

    <?php
        include 'footer.php';
    ?>


	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<script src="vendor/parallax100/parallax100.js"></script>

	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>

	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
    <script>
        function login(){
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                url: "akcije/uloguj.php",
                method: "POST",
                data: {
                    username : username,
                    password : password
                }
            }).done(function(text) {
                if(text == 'Korisnik uspesno ulogovan'){
                    location.href = 'index.php';
                }else{
                    $("#details" ).html(text);
                }

            });
        }
    </script>
	<script src="js/main.js"></script>

</body>
</html>