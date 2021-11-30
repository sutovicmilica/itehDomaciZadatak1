<?php

require 'sesija.php';

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
					Outfiti
				</h3>
			</div>
            <div class="row" style="padding-bottom: 40px">
                <div class="col-12">
                    <label for="pretraga">Pretrazi po korisniku</label>
                    <input type="text" id="pretraga" class="form-control">
                    <label for="sortiranje">Sortiraj po broju svidjanja</label>
                    <select id="sortiranje" class="form-control">
                        <option value="desc">Sa najvise lajkova</option>
                        <option value="asc">Sa najmanje lajkova</option>
                    </select>
                    <br/>
                    <button type="button" class="btn btn-dark" onclick="pretrazi()">Pretrazi</button>
                </div>
            </div>

			<div id="rezultati" class="row">

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
	<script>
        $('.parallax100').parallax100();
	</script>
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
        function pretrazi(){
            var pretraga = $("#pretraga").val();
            var sortiranje = $("#sortiranje").val();

            $.ajax({
                url: "akcije/pretraga.php",
                method: "POST",
                data: {
                    pretraga : pretraga,
                    sortiranje : sortiranje
                }
            }).done(function(text) {
                $("#rezultati" ).html(text);
            });
        }
        pretrazi();

        function lajkuj(outfitID){
            $.ajax({
                url: "akcije/lajkuj.php",
                method: "POST",
                data: {
                    outfitID : outfitID
                }
            }).done(function(text) {
                pretrazi();
            });
        }
    </script>
	<script src="js/main.js"></script>

</body>
</html>