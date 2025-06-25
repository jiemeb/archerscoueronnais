<?php
session_start();
include("inc/connexion.php");
 ?>

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

	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body scroll=yes>
  <div class="container">
    <div class="row">
      <div class="col-sm-2 d-none d-sm-block"><img src="/images/logo.jpg" class="img-fluid" /></div>
      <div class="col-sm-8">
        <h1>Archers de Coüeron</h1>
        <h2>Inscriptions saison 2022-2023</h2>
      </div>
      <div class="col-sm-2 d-none d-sm-block text-end"><img src="/images/cible.gif" class="img-fluid" /></div>
    </div>
  </div>

<?php
if(isset($_SESSION['authorized']))
{
/*
if( empty($_SESSION["login"]) || empty($_SESSION["passwd"]) ) {
		echo '<form name="form_error" action="form_error.php" method="post">';
		echo '</form>';
		echo '<script language="javascript">';
	 	echo 'form_error.submit();';
		echo '</script>';
		echo '</body>';
		echo '</html>';
	}
*/



	 $sql = "SELECT   categories, civilite, prenom, nom,dateNaissance, listAttente   from adherents order by dateNaissance desc " ;




// on envoie la requête
//$req = mysqli_query($connexion,$sql) 
$req = mysqli_query($connexion,$sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement

while($data = mysqli_fetch_assoc($req))
    {
	echo '<div class="row">';
		echo'		<div class="col-md">';
		echo'					<div class="mb-2"> ';
		echo  $data['categories'] ;
		echo'					</div> ';
		echo'				</div> ';

		echo'		<div class="col-md">';
		echo'					<div class="mb-2"> ';
		echo $data['civilite']			;
		echo'					</div> ';
		echo'				</div> ';

		echo'		<div class="col-md">';
		echo'					<div class="mb-2"> ';
		echo $data['prenom']			;
		echo'					</div> ';
		echo'				</div> ';

		echo'		<div class="col-md">';
		echo'					<div class="mb-2"> ';
		echo $data['nom']			;
		echo'					</div> ';
		echo'				</div> ';

				echo'		<div class="col-md">';
				echo'					<div class="mb-2"> ';
				echo $data['dateNaissance']			;
				echo'					</div> ';
				echo'				</div> ';

		echo'		<div class="col-md">';
		echo'					<div class="mb-2"> ';
		echo $data['listAttente']			;
		echo'					</div> ';
		echo'				</div> ';

		echo '</Div>';
    }



mysqli_close($connexion);
}

?>
