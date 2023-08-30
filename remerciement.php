<?php
session_start();

include("inc/prixCotisation.php");
//include("css/styleResultat.css");
//include("css/style.css");


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

<!--
<div>
  <input type='button' value='print' onclick='PrintDiv();' />
</div> -->
<?php
$dest=$_SESSION['email1'];
echo "<h1> Merci de votre inscription au Club de l'ESC tir à l'arc </h1>
Nous vous contacterons pour confirmer votre inscription.
Celle-ci ne sera définitive qu'à la réception de votre dossier complet, contenant l'intégralité des documents demandés.
Nous prendrons rendez-vous pour prendre les mensurations de l'archer et faire un essai pour confirmer votre décision<br>
<br>Votre email de liaison est: ".$dest."<br><br>Cordialement<br><br>Le Bureau des Archers de Couëron
";




/** Nouvelle fonction mail pour le FAI Free, conforme au standard
* De temps en temps les courriels ne sont pas envoyés, mais pourtant la fonction mail() renvoie True
* ce qui n'est pas conforme a la spécification PHP de cette fonction.
* De manière empirique, il a été déterminée qu'un temps d'envoi au moins égal à 2 secondes est une garantie que le courriel
* est vraiment envoyé.
* Si le mail est vraiment envoyé, une notification de rejet est bien envoyé par Free à l'adresse de l'expéditeur du message
* Copyright 2013 - a@a.a <tmp12311@free.fr>
* Licence : CeCILL-B, http://www.cecill.info
* Merci à Gaming Zone <http://gaming.zone.online.fr> pour ses tests ayant permis de déterminer la durée
* */


function mailFree($to , $subject , $message , $additional_headers=null , $additional_parameters=null) {
$start_time = time();
$resultat=mail ( $to , $subject, $message, $additional_headers, $additional_parameters);
$time= time()-$start_time;
return $resultat & ($time>1);
}
/** Fin de la définition de la fonction*/

/** Le code qui suit est juste donné comme exemple de test de la fonction
*
* Code de test de la fonction
* Modifié par Al <les.pages.perso.chez(chez)free.fr>
*  */

/* Mettre ici l'adresse mail de votre site Web : si votre site est http://monsite.free.fr/ alors votre adresse email est monsite@free.fr */

$admin = 'Jean-Marie Bonnand <archerscoueronnais@free.fr>';
$message = '<html lang="fr">
<head>
<meta charset="utf-8" />
<title>Les archers de Coueron</title>
<meta name="r" content="noindex,nofollow,noarchive"/>
</head><body>
<h1> Merci de votre inscription au Club de l'."'ESC tir à l'".'arc </h1>
<br><br> ce mail  vous est envoyé pour confirmer votre Inscriptions <br>
celle-ci ne sera définitive que lors de la complétude des documents demandés <br>
Cordialement<br>
Jean-Marie Bonnand
'.$dest.'
</body></html>';



//$dest=$_SESSION['email1'];
$dest='archersdecoueron@gmail.com';

$sujet='Inscription tir à l\'arc '.date("H:i:s");
//$message="Ma foi,\nTout semble fonctionner correctement.\n\nEnvoyé depuis l'IP={$_SERVER["REMOTE_ADDR"]}";
$additional_headers = "From: $admin\r\n";
$additional_headers .= "Cc: $admin\r\n";
$additional_headers .="Return-Path: $admin\r\n";
$additional_headers .= "MIME-Version: 1.0\r\n";
$additional_headers .= "Content-type: text/html; charset=UTF-8\r\n";
// $additional_headers .="Reply-To: $admin\r\n";

//$result=mailFree( $dest, $sujet , $message, $additional_headers  );
if ($dest != "")

{
	$result=mailFree( $dest, $sujet , $message, $additional_headers  );
if ($result == 1 )
{
			echo '.';
// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
/*if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}*/
// Finalement, on détruit la session.
session_destroy();

}
	else
  	echo ("<label class=grasrouge><br>rafraichir la page SVP touche F5 </label>");
}

?>
</body>
</html>
