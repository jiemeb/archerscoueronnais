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
				<h2>Inscriptions saison 2023-2024</h2>
			</div>
			<div class="col-sm-2 d-none d-sm-block text-end"><img src="/images/cible.gif" class="img-fluid" /></div>
		</div>
	</div>


<?php


# On récupère l'identifiant (clé) de la question posée dans la session
$id_question_posee = $_SESSION['captcha']['id_question_posee'];

# On récupère la réponse de l'utlisateur
$reponse_utilisateur = $_POST['captcha_reponse'];

# Vérification de la réponse : si la réponse de l'utilisateur n'est pas dans la liste des réponses exactes, on affiche un message d'erreur
if( !in_array($reponse_utilisateur, $liste_questions[$id_question_posee]['reponses']) ){
    echo "Vous avez répondu $reponse_utilisateur à la question captcha, ce n'est pas une bonne réponse. Traitement annulé";
    ?>
    <a href="formulaire1.php"><img title="retour au début" style="border: 0px solid ;" alt= "bouton retour"src="images/bt_retour.gif"></a>
    <?php
    die();
}

$arrayValue= array('categories','civilite','prenom','nom','dateNaissance','nationalite','email1','email2','telephone1','telephone2','adresse','cp','commune','nomRep1','prenomRep1','nomRep2','prenomRep2','droitimageClub','droitimagePress','kit','lot','prix','listAttente');

// test si réinscription

$sqlNom="SELECT COUNT(*) AS 'count' FROM `adherentsOld` where nom =  '".$_POST['nom']."' ";

$row= $db->query( $sqlNom)->fetch() ;

	echo " valeur ".$row['count']. " inscriptions ".$inscription ;

if ($row['count'] == 0 AND $inscription == 0)
{
//	echo " valeur ".$row['count']. " inscriptions ".$inscription ;
	echo "<h2> ERREUR </h2>".$_POST['prenom']." ".$_POST['nom']." n'est pas un(e) archer(e) du club.<div> Vous devez attendre que le site soit ouvert aux inscriptions.</div><h3> Traitement annulé</h3>";
    ?>
    <a href="formulaire1.php"><img title="retour au début" style="border: 0px solid ;" alt= "bouton retour"src="images/bt_retour.gif"></a>
    <?php
    die();

}

//Calcul cout inscription  plus kit

print ("vous avez : <br>");
$prix = 0;
echo "<table>";
if ($_POST['kit'] == 'oui') {echo("<tr><td>&ensp;Kit </td><td>".$kit." €</td></tr>");$prix += $kit ;}
if ($_POST['lot'] == 'oui') {echo("<tr><td>&ensp;3 flèches supplémentaires </td><td>".$lot." €</td></tr>");$prix += $lot ;}
echo("<tr><td>&ensp;Licence </td><td>".$license[$_POST['categories']]." €</td></tr></table>");$prix += $license[$_POST['categories']];print ("&emsp;Total = ".$prix." €<br>") ;





 // test si le nombre de poussins est attteint
$listAttente = 1;
if($_SESSION['categories'] == 0)
{

//	$result = mysqli_query($connexion, "SELECT COUNT(*) AS `count` FROM `adherents` where categories = 0");
	$row = $db->query( "SELECT COUNT(*) AS `count` FROM `adherents` where categories = 0")->fetch();

 //$row = mysqli_fetch_array($result);

				$rangPoussin= $row['count'] - $comptePoussins;
					$listAttente = $rangPoussin + 1;
				 if ($rangPoussin >= 0 )
				 	print("<span class=grasrouge>vous etes en liste attente ".$listAttente."</span>");

 }
 // test si le nombre de jeunes est attteint
 if($_SESSION['categories'] != 0 && $_SESSION['categories'] != 5 )
 {

 //	$result = mysqli_query($connexion, "SELECT COUNT(*) AS `count` FROM `adherents` where categories != 0 AND categories != 5");
  $row= $db->query( "SELECT COUNT(*) AS `count` FROM `adherents` where categories != 0 AND categories != 5")->fetch() ;
  //$row = mysqli_fetch_array($result);

 				$rangJeunes= $row['count'] - $compteJeunes;
 					$listAttente = $rangJeunes + 1;
 				 if ($rangJeunes >= 0 )
				 	print("<span class=grasrouge>vous etes en liste attente ".$listAttente."</span>");
  }



	$data = array ();
	foreach($arrayValue as $val )
	{
		$_SESSION[$val] = isset ($_POST[$val])? $_POST[$val] : "";
		$data[$val] = $_SESSION[$val] ;
		if (empty($elementsInsert))
		{
		$elementsInsert =$val." ";
		$elementsInsertData =":".$val." ";
		}
		else
		{
		$elementsInsert =$elementsInsert.",".$val." ";
		$elementsInsertData =$elementsInsertData.",:".$val." ";
		}
	}

	$_SESSION['prix']=$prix;
	$data['prix'] = $prix ;
	$data['listAttente'] = $listAttente ;


//
print ("<br>Veuillez editer, signer les dossiers suivant et nous les renvoyer au format papier ou électronique<br>");

$sql = "INSERT INTO adherents (".$elementsInsert." )
 VALUES (".$elementsInsertData." )";

try
{
	$db->prepare( $sql)->execute($data);
}

 catch (Exception $e){
			echo '<label class=grasrouge>Une erreur est intervenu lors de l\'enregistrement de votre inscription.<br>
			 Veuillez me contacter <br>
			&nbsp &nbsp par mail: archersdecoueron@gmail.com ou par téléphone au 0240432800.
			<br></label>';
      echo "Erreur : " . $sql . "<br>" . mysqli_error($connexion);
}
unset ($db) ;

?>

<div class="col mb-5 mt-5">
	<a href="dossierInscription.php" class="btn btn-secondary">edittion de l'inscription <i class="fas fa-angle-right"></i></a>
</div>
