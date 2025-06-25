<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>


<?php
$arrayValueFixe  = array ("categories", "civilite", "nom", "prenom", "dateNaissance","nationalite", "email1","email2","telephone1","telephone2","adresse","cp","commune","nomRep1","prenomRep1" ) ;
// Valeur a éditer
$arrayValue= array("arcType","certificat","dossier", "licence", "groupe","remarque");

if(isset($_SESSION['authorized']))
{

	 $sqlArcher = "SELECT   id_adherent, prenom, nom  from adherents order by dateNaissance desc ;" ;

$reqArcher = $db->query($sqlArcher) ;

?>
<form id='selectArcher' method='post'>
<select name="archer" size="1">
<?php
while ($rowArcher = $reqArcher->fetch())
{
		$archerName=$rowArcher['prenom']." ".$rowArcher['nom'];
	if(isset($_POST['archer']))
	{
		if ($rowArcher['id_adherent'] == $_POST['archer'] )
		{
		echo "<option value=".$rowArcher['id_adherent']." selected >".$archerName.'</option>' ;
		}
		else
		{
		echo "<option value=".$rowArcher['id_adherent'].">".$archerName.'</option>' ;
		}
	}else
		echo "<option value=".$rowArcher['id_adherent'].">".$archerName.'</option>' ;

}
echo '</select>' ;
echo "<input type='submit' value='submit' form='selectArcher'>";
echo '</form>';

if(isset($_POST['archer']))
{
$archerSelected=$_POST['archer'] ;

$elements = "";
foreach($arrayValue as $element)
{
$elements =$elements.",".$element." ";
}

$elementsFixe = "";
foreach($arrayValueFixe as $element)
{

if (empty($elementsFixe))
$elementsFixe =$element." ";
else
$elementsFixe =$elementsFixe.",".$element." ";
}

$sql = "SELECT   ".$elementsFixe.$elements." from adherents where id_adherent = ".$archerSelected.";"  ;
//var_dump ($sql);
try {
$data = $db->query($sql)->fetch();
}
catch (Exception $E)
{
	die('Erreur SQL !<br>'.$e.'<br>');
}


 ?>

<div class='container'>
<div class='row'>
<div class='col'>
<form  method='post' id='formulaire'>
<input type='hidden' name='archerSelected' value="<?php echo $archerSelected; ?>">
<?php

echo "<div class='col-md'>";
echo "	<div class='mb-3'>";
echo "<img src='../photos/".str_replace(' ','',$data['prenom'])."_".str_replace(' ','',$data['nom'])
.".png '  width='200' >";
echo "	</div> ";
echo "</div> ";
$i=0;
 foreach($arrayValueFixe as $element)
 {
	 if (!($i%6))
	 {   echo "</div>";
		 echo "<div class='row'>";
	 }

 $i++;
echo "<div class='col-md'>";
echo "	<div class='mb-2'>";
echo "<label class='form-label'>".$element."=</label>" ;
if ($element == "dateNaissance")
{
echo date( 'd/m/Y',strtotime($data[$element])) ;
}
else
{
	echo  $data[$element] ;
}

echo "	</div> ";
echo "</div> ";
 }
 echo "</div>" ;


$i=0;
foreach($arrayValue as $element)
{
	if (!($i%6))
	{   echo "</div>";
		echo "<div class='row'>";
	}

$i++;
echo'		<div class="col-md">';
echo'					<div class="mb-2"> ';
echo "<label class='form-label'>".$element."</label>" ;
echo "<input type='text' name=".$element." id='".$element."' class='form-control' value='".$data[$element]."' >";
echo'					</div> ';
echo'		</div> ';

}
echo "</div>" ;

		echo "<div class='row'>";
		echo "<input class='btn btn-success' type='submit' value='Validez' form='formulaire' >" ;
		echo "</Div>";

}

if (isset ( $_POST['archerSelected']))
{
	$elements = "";

foreach($arrayValue as $element)
 {

	if(isset($_POST[$element])&& !empty($_POST[$element]) )
	{
		if(!empty($elements))
		{
			$elements=$elements.',' ;
		}
		$elements=$elements." ".$element."= :".$element;

		$data[$element]=$_POST[$element];

	}

 }
 	if(!empty($elements))
	{
	try {
	$sql = "update  adherents set ".$elements."  where id_adherent = ".$_POST['archerSelected']  ;
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
