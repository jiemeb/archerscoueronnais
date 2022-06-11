<?php
session_start();

include("inc/prixCotisation.php");



?>
<html>
<head>
<title>Archers de Coueron</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript">
   function PrintDiv() {
      var divToPrint = document.getElementById('divToPrint');
      var popupWin = window.open('', '_blank', 'width=400,height=500');
      popupWin.document.open();
      popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
           }
</script>

</head>
<link type="text/css" rel="stylesheet" href="css/style.css">
<body scroll=no>
<div class="myHeader">
	<div class="myHeader1"> </div>
	<div class="myHeader2" >
		<h1>Archers de Coüeron</h1>
		<h2>Inscriptions saison 2022-2023</h2>
	</div>
	<div class="myHeader3"> </div>

</div>
<hr>

<div id="divToPrint" style="display:block;">

    <?php  //<div style="width:200px;height:300px;background-color:teal;">

print ( "
<h2>AUTORISATION PARENTALE  - VALIDITÉ SAISON 2022 2023</h2>
<pre>

Pour un enfant mineur ou autorisation pour un incapable majeur



Madame, Monsieur,


Vous avez inscrit votre enfant à l’ESC Tir à l’Arc de Couëron pour la saison 2022/2023, et nous vous en remercions.
Nous vous rappelons que la section n’est plus responsable de votre enfant en dehors des horaires et jours d’entraînement.
Durant cette année votre enfant peut être amené à participer à des concours.
Pour qu’il puisse être pris en charge pour son transport, par la section ou une autre famille,
 nous vous invitons à compléter et signer la décharge parentale ci-dessous.
Dans le cas contraire, votre enfant devra se rendre sur les différents lieux de rencontre par ses propres moyens.
Je soussigné [e], nom et prénom du représentant légal :


</pre>".$_SESSION['nomRep1']." ".$_SESSION['prenomRep1'].".<pre>




Demeurant : </pre>".$_SESSION['adresse']." ".$_SESSION['cp']." ".$_SESSION['commune']." <pre>


Décharge l’ESC Tir à l’Arc de Couëron de toute responsabilité concernant l’enfant [nom- prénom] :

</pre>	"

.$_SESSION['nom']." ".$_SESSION['prenom']."<pre>




en dehors des lieux, jours et horaires d’entrainement.
Par la présente, je donne mon accord à l’ESC Tir à l’Arc de Couëron ou à l’un des accompagnateurs à transporter l’enfant,
 nommé ci-dessus, aux différentes compétitions.
En cas de blessure ou d’accident, j’autorise le responsable de la structure qui accueille, ou l’entraîneur à contacter
les services d’urgences et à prendre les décisions qui s’imposent dans les plus brefs délais afin de faire face à toutes
les situations.

Je note que je dois m’assurer de la présence du responsable d’entraînement au sein de la structure avant de laisser mon enfant.
Je dois m’assurer que la séance d’entraînement a bien lieu [possibilité d’annulation pour intempéries ou raison de force majeure] et
je m’engage à venir récupérer mon enfant ou incapable majeur en respectant les horaires qui m’ont été communiqués.

Fait à :  .... ...... ...... ..... ...... ...... ...... ..... ...... ...... ....	le : . . . . . . . . . . . .

Signature du représentant légal :




</pre>

</div>
<div>
  <input type='button' value='print' onclick='PrintDiv();' />
</div"
);



  ?>
  <div>
    <br>
<a href="reglement.php"><img title="edittion du reglement" style="border: 0px solid ;" alt= "bouton suivant"src="images/bt_suivant.gif"></a>
</div>
