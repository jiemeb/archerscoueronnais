<?php

// 1 - Param�tres de connexion � la base de donn�es.

	$userDB 		= "archerscoueronnais";
	$passDB 		= "2020ESCArchers";
//$serverDB 	= "sql.free.fr";
  $serverDB 	= "127.0.0.1";
	$databDB 		= "archerscoueronnais";

	$connexion = mysqli_connect($serverDB,$userDB,$passDB);


// Souvent on identifie cet objet par la variable $conn ou $db
try {
$db = new PDO(
    'mysql:host='.$serverDB.';dbname='.$databDB.';charset=utf8',
	$userDB,
    $passDB
);
}
catch (Exeption $e){
	die ( 'Erreur connexion : '.$e->getMessage());
}



?>
