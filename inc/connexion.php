<?php

// 1 - Param�tres de connexion � la base de donn�es.

	$userDB 		= "archerscoueronnais";
	$passDB 		= "2020ESCArchers";
//$serverDB 	= "sql.free.fr";
  $serverDB 	= "127.0.0.1";
	$databDB 		= "archerscoueronnais";

	$connexion = mysqli_connect($serverDB,$userDB,$passDB);

//	mysql_select_db($userDB,$connexion) or die ("impossible de se connecter a la base de donnees");
mysqli_select_db($connexion,$userDB) or die ("impossible de se connecter a la base de donnees");
	mysqli_query($connexion,'SET NAMES utf8');
// 1 - Fin.

?>
