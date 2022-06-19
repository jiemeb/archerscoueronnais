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
  $arrayValueFixe  = array ("categories", "civilite", "prenom", "nom","dateNaissance", "listAttente","email1","telephone1","kit","lot" ) ;

  if(isset($_GET['nbLigne']))
  {
    $_SESSION['nbLigne'] = $_GET['nbLigne'] ;
  }
  if(isset ($_SESSION['nbLigne']))
   {
    $nbLigne=(int)$_SESSION['nbLigne'];
  }
  else
  {
  $nbLigne=9 ;
  }

  $elementsFixe = "";
  foreach($arrayValueFixe as $element)
  {

  if (empty($elementsFixe))
  $elementsFixe =$element." ";
  else
  $elementsFixe =$elementsFixe.",".$element." ";
  }
	 $sql = "SELECT   ".$elementsFixe."  from adherents order by dateNaissance desc " ;




// on envoie la requête
//$req = mysqli_query($connexion,$sql)
$req = mysqli_query($connexion,$sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
//echo "<label class='form-label'>element par ligne</label>" ;
//echo "<input type='text' name=nnLigne id='nbLigne' class='form-control' value=".$nbligne." >";

while($data = mysqli_fetch_assoc($req))
    {

    $i=0;

	  echo '<div class="row" >';


    foreach($arrayValueFixe as $element)
    {
   	 if (!($i%$nbLigne))
   	 {   echo "</div>";
   		 echo "<div class='row'>";
   	 }

    $i++;
   echo "<div class='col-md'>";
   echo "	<div class='mb-2'>";
      echo "<label class='form-label'>".$element."=</label>" ;
  echo  $data[$element] ;
   echo "	</div> ";
   echo "</div> ";

    }

		echo '</Div>';
    }



mysqli_close($connexion);
}

?>
