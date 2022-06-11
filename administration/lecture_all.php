<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexion.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>


<?php
if(isset($_SESSION['authorized']))
{

	 $sql = "SELECT   categories, civilite, prenom, nom,dateNaissance, listAttente ,dossier  from adherents order by dateNaissance desc " ;




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

    echo'		<div class="col-md">';
    echo'					<div class="mb-2"> ';
    echo $data['dossier']			;
    echo'					</div> ';
    echo'				</div> ';

		echo '</Div>';
    }



mysqli_close($connexion);
}

?>
