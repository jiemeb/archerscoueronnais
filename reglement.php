<?php
session_start();

include("inc/prixCotisation.php");
//include("css/styleResultat.css");
//include("css/style.css");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Archers de Coueron</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link type="text/css" rel="stylesheet" href="css/styleResultat.css" />-->
   <link type="text/css" rel="stylesheet" href="css/styleResultat.css" media="screen"/>
  <link type="text/css" rel="stylesheet" href="css/styleResultatPrint.css" media="print"/>


</head>
<body scroll=no>
<div class="myHeader">
	<div class="myHeader1"> </div>
	<div class="myHeader2" >
		<h1>Archers de Coüeron</h1>
		<h2>Inscriptions saison 2021-2022</h2>
	</div>
	<div class="myHeader3"> </div>
</div>




  <div class="col mb-5 mt-5">
  	<a href="remerciement.php" class="btn btn-secondary">finalisation<i class="fas fa-angle-right"></i></a>
  </div>


<hr>

<div id="divToPrint" style="display:block;">
<embed src=http://archerscoueronnais.free.fr/doc/Règlement.pdf width=800 height=500 type='application/pdf'/>

</div>
