<?php
session_start();

include("inc/constant.php");








print ("Nom ".$_SESSION['nom']);

if ( $_SESSION['categories'] < 5 )
{
  ?>
  <a href="attestationParentale.php"><img title="edittion de l\'attestation Parentale" style="border: 0px solid ;" alt= "bouton suivant" src="images/bt_suivant.gif"></a>

<?php
}

 ?>
