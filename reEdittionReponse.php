<?php
session_start();

include("inc/connexionPDO.php");
include("inc/prixCotisation.php");
# Liste des questions avec leurs différentes réponses possibles
include("inc/questionsCaptcha.php");
# Activation des sessions (pour que PHP charge la session de l'utilisateur, via le cookie PHPSESSID)
# à placer impérativement avant tout affichage, car cette fonction a besoin d'envoyer des headers HTTP

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



$arrayValue= array('categories','civilite','prenom','nom','dateNaissance','nationalite','email1','email2','telephone1','telephone2','adresse','cp','commune','nomRep1','prenomRep1','nomRep2','prenomRep2','droitimageClub','droitimagePress','kit','lot','prix','listAttente');

//Calcul cout inscription  plus kit







 // test si le nombre de poussins est attteint
$listAttente = 1;

$elements = "";
foreach($arrayValue as $element)
{
if (empty($elements))
$elements =$element." ";
else
$elements =$elements.",".$element." ";
}



	$data = array ();

$sql = "select ".$elements."from adherents where nom='".$_GET['nom']."' and prenom='".$_GET['prenom']."' ;" ;
//var_dump ($sql);
try
{
	$data=$db->query ($sql)->fetch();
}

 catch (Exception $e){
			echo '<label class=grasrouge>Une erreur est intervenu lors de l\'enregistrement de votre inscription.<br>
			 Veuillez me contacter <br>
			&nbsp &nbsp par mail: archersdecoueron@gmail.com ou par téléphone au 0240432800.
			<br></label>';
  //    echo "Erreur : " . $sql . "<br>" . mysqli_error($connexion);
}
//var_dump($data);
unset ($db) ;
	
	foreach($arrayValue as $val )
	{
		$_SESSION[$val] = isset ($data[$val])? $data[$val] : "";
	}

// A faire récuperartion kit et 
print ("vous avez : <br>");
$prix = 0;
echo "<table>";
if ($_SESSION['kit'] == 'oui') {echo("<tr><td>&ensp;Kit </td><td>".$kit." €</td></tr>");$prix += $kit ;}
if ($_SESSION['lot'] == 'oui') {echo("<tr><td>&ensp;3 flèches supplémentaires </td><td>".$lot." €</td></tr>");$prix += $lot ;}
echo("<tr><td>&ensp;Licence </td><td>".$license[$_SESSION['categories']]." €</td></tr></table>");$prix += $license[$_SESSION['categories']];print ("&emsp;Total = ".$prix." €<br>") ;

echo $_SESSION['nom']." ".$_SESSION['prenom'] ;

//
print ("<br>Veuillez editer, signer les dossiers suivant et nous les renvoyer au format papier ou électronique<br>");


?>

<div class="col mb-5 mt-5">
	<a href="dossierInscription.php" class="btn btn-secondary">edittion de l'inscription <i class="fas fa-angle-right"></i></a>
</div>
