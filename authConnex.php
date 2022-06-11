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

	<!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


	<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
   echo "bada" ;
/*
	if( isset($_GET) && (!empty($_GET["idUser"])) && (!empty($_GET["passWord"]))) {

		$idUser 		= base64_decode($_GET["idUser"]);
		$passWord 	= base64_decode($_GET["passWord"]);
	}
*/


	 	$idUser 	= $_POST["idUser"];
		$passWord 	= $_POST["passWord"];


		$result = "select id_user, mot_passe ,authorized from users where id_user = '".$idUser."';";
		   echo "sql ".$result ;
		$myQueryRes = mysqli_query ($connexion,$result) or die("Une erreur est survenue dans l'�x�cution de la requ�te.");


			if ($manager_row = $myQueryRes->fetch_assoc()) {
		 	$id_user		=  $manager_row ['id_user'];
			$mot_passe		= $manager_row ['mot_passe'];
			$authorized		= $manager_row ['authorized'] ;


			echo 'coucou connect '.$id_user.' passe '.$mot_passe ;

			if( $id_user == $idUser && $passWord == $mot_passe ){
				$_SESSION['login'] 	= $id_user;
				$_SESSION['passwd']	= $mot_passe;
				$loginOK = 1;

				echo '<form name="myForm" action="lecture_all.php" method="post">';
				echo 'coucou connect '.$idUser ;
				echo '</form>';
				echo '<script language="javascript">';
			 	echo 'myForm.submit();';
				echo '</script>';
				echo '</body>';
				echo '</html>';
			}else{
				$loginOK = 0;
				echo 'coucou pas  '.$idUser ;
			}
		}else{
			echo 'connexion bad sql ';
			$id_user			= "";
			$mot_passe		= "";
			$loginOK 			= 0;
		}


if( $loginOK != 0 ){
	echo '<form name="form_error" action="form_error.php" method="post">';
	echo '</form>';
	echo '<script language="javascript">';
 	echo 'form_error.submit();';
	echo '</script>';
	echo '</body>';
	echo '</html>';
}
?>
