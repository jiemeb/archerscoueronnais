<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>


<?php
if(isset($_SESSION['authorized']))
{
  $arrayValueFixe  = array ("categories", "civilite", "prenom", "nom","dateNaissance", "listAttente","email1","telephone1","kit","lot" ) ;

 

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
try {
$req = $db->query($sql) ;
}
catch (Exception $E)
{
  echo 'Erreur connexion a la base';
  die();
}

echo '<div> </div>' ;
echo '<table  border-collapse: collapse>' ;
echo '<caption>Lecture total licencié </caption>';

echo '<thead>' ;
echo '<tr>';
foreach($arrayValueFixe as $element)
{

//echo "<div class='col-md'>";
//echo "	<div class='mb-5'>";
echo '<th>' ;
echo "<label class='form-label'>".$element."</label>" ;
echo '</th>' ;
//echo "	</div> ";
//echo "</div> ";

}
//echo '</div>';
echo '</tr>' ;
echo '</thead>' ;
echo '<tbody>' ;
// on fait une boucle qui va faire un tour pour chaque enregistrement
//echo "<label class='form-label'>element par ligne</label>" ;
//echo "<input type='text' name=nnLigne id='nbLigne' class='form-control' value=".$nbligne." >";


while($data = $req->fetch())
    {

      echo '<tr>' ;
// echo '<div class="row" >';
    foreach($arrayValueFixe as $element)
    {
echo '<td>' ;
   echo "<div class='col-md'>";
   echo "	<div class='mb-5'>";
//   echo "<label class='form-label'>".$element."=</label>" ;
   echo  $data[$element] ;
   echo "	</div> ";
   echo "</div> ";
   echo '</td>' ;
    }
	//	echo '</Div>';
  echo '</tr>' ;
  }

  echo '</tbody>' ;

//    echo '</div>';
echo '</table>' ;
unset($db);
}

?>
