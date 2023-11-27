<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>


<?php

$arrayValue= array("concoursName" ,"concoursDate" ,"referent", "note" ,"prixAdulte" ,"prixEnfant");

if(isset($_SESSION['authorized']))
{

?>
<form id='concours' method='post'>

<?php
$i=0;
foreach($arrayValue as $element)
{
	if (!($i%3))
	{   echo "</div>";
		echo "<div class='row'>";
	}

$i++;
echo'		<div class="col-md">';
echo'					<div class="mb-2"> ';
echo "<label class='form-label'>".$element."</label>" ;
echo "<input type='text' name=".$element." id='".$element."' class='form-control'  >";
echo'					</div> ';
echo'		</div> ';

}
echo "</div>" ;

		echo "<div class='row'>";
		echo "<input class='btn btn-success' type='submit' name='valid' value='Validez' form='concours' >" ;
		echo "</Div>";

		echo "<div class='row'>";
	//	echo "<input class='btn btn-cancel' type='submit' name='cancel' value='annulez' form='concours' >" ;
		echo "<a href='gestionConcours.php' class='btn btn-secondary'>Retour <i class='fas fa-undo'></i></a>" ;
		echo "</Div>";

		echo '</form>';

if (isset ( $_POST['valid']))
{
	$elements = "";
	$elementsValue ="";
	$i="";
foreach($arrayValue as $element)
 {

	if(isset($_POST[$element]) && !empty($_POST[$element]) )
	{
		if(!empty($elements))
		{
			$elements=$elements.',' ;
			$elementsValue=$elementsValue.',';
		}
		$elements=$elements." ".$element;
		$elementsValue=$elementsValue." :".$element ;
		$data[$element]=$_POST[$element];

	}

 }
 	if(!empty($elements))
	{
	try {
	$sql = "insert into concours  ( ".$elements."  ) VALUES ( ".$elementsValue.") " ;
	//$sql = "update  adherents set ".$elements."  where id_adherent = ".$_POST['archerSelected']  ;
    //echo $sql ;
	//var_dump($data);
	$req = $db->prepare($sql)->execute($data);
	}
	catch (Exception $E)
	{
		echo 'Erreur SQL !<br>'.$sql.'<br>';

	}
	}

}
unset($db);
}
?>
