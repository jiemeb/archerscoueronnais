<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>


<?php
$arrayValueFixe  = array ("categories", "civilite", "prenom", "nom","dateNaissance", "listAttente","email1","telephone1","kit","lot","dossier" ,"certificat", "debutant"  ,"chequeKit"  ,"chequeCotisation" ) ;
// Valeur a éditer
$arrayValue= array();

if(isset($_SESSION['authorized']))
{

	 $sqlDossier = "SELECT   dossier  from adherents group by dossier ;" ;
// on envoie la requête
//$req = mysqli_query($connexion,$sql)
//$reqDossier = mysqli_query($connexion,$sqlDossier) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
try { 
	$reqDossier = $db->query($sqlDossier);
} catch (Exception $E) {
	die('Erreur SQL !<br>'.$sql.'<br>');
}

?>
<form id='selectDossier' method='post'>
<label for="dossiers">Choisir dossier:</label>
<select name="Dossier" id="dossiers" size="1">
<?php
echo '<option value="tous">tous</option>' ;
while ($rowDossier = $reqDossier->fetch())
{
if (!empty ($rowDossier['dossier']))
	{
		$elementSelect= $rowDossier['dossier'];
		echo '<option value="'.$elementSelect.'">'.$elementSelect.'</option>' ;
	}
else
	echo '<option value="vide">absent</option>' ;
}
echo '</select>' ;
?>
<label for="categories">&nbsp Choisir categorie:</label>
<select name="Categories" id="Categories" size="1">
	<option value=-1 >tous</option>
	<option value=0  >poussin</option>
	<option value=1  >benjamin</option>
	<option value=2  >minime</option>
	<option value=3  >cadet</option>
	<option value=4  >jeune</option>
	<option value=5  >senior</option>
<?php


echo "<input type='submit' value='submit' form='selectDossier'>";
echo '</form>';

if(isset($_POST['Dossier']))
{
$dossierSelected=$_POST['Dossier'] ;
$categorie=$_POST['Categories'];
if ($categorie == -1)
	$categorie = "%%" ;
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
if($dossierSelected == "tous")
{
 $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where categories like "'.$categorie.'";' ;
 $sqlEmail = 'SELECT   email1 ,email2 from adherents where categories like "'.$categorie.'";' ;
}
else if($dossierSelected == "vide")
{
	$sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where dossier IS NULL and categories like "'.$categorie.'";' ;
	$sqlEmail = 'SELECT  email1 ,email2 from adherents where dossier IS NULL and categories like "'.$categorie.'";' ;
  }
else
{
  $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where dossier = "'.$dossierSelected.'" and categories like "'.$categorie.'";' ;
  $sqlEmail = 'SELECT   email1 ,email2 from adherents where dossier = "'.$dossierSelected.'" and categories like "'.$categorie.'";' ;
}
  //}
//var_dump ($sql);
try {
$req = $db->query($sql) ;
$reqEmail = $db->query($sqlEmail);
}
catch (Exception $E) {
die('Erreur SQL !<br>'.$sql.'<br>');
} 
?>
<!--<input type='hidden' name='dossierSelected' value="<?php echo $dossierSelected; ?>">-->
<input  name='dossierSelected' value="<?php echo $_POST['Dossier']; ?>">

<table  class= grasrouge>
<thead>
<tr>
<?php
// Entete de colonne
foreach ($arrayValueFixe as $element)
{
	echo '<th>' ;
	echo "<label class='form-label'>".$element."</label>" ;
	echo '</th>' ;
}
foreach($arrayValue as $element)
{
	echo '<th>' ;
	echo "<label class='form-label'>".$element."</label>" ;
	echo '</th>' ;
}
echo '</tr>' ;
echo '</thead>' ;
echo '<tbody>' ;
// Dumpt DATA
while ($data = $req->fetch())
{
	echo '<tr>' ;
 foreach($arrayValueFixe as $element)
 {

	echo '<td>' ;
	echo "<label class='form-label'>".$data[$element]."</label>" ;
	echo '</td>' ;
 }


foreach($arrayValue as $element)
{

	echo '<td>' ;
	echo "<label class='form-label'>".$data[$element]."</label>";
	echo '</td>' ;

}
echo '</tr>' ;


}
echo '</tbody>' ;
echo '</table>' ;

echo "<p></p>" ;echo "<p><b><u>Adresse mail de votre selection</u></b></p>" ;echo "<p></p>" ;
echo "<div>";
$i = 0;
while ($data = $reqEmail->fetch())
{
if(!empty($data['email1']))
	{
		echo $data['email1']."," ;
	}	

if(!empty($data['email2']))
	{
		echo $data['email2']."," ;
	}		
$i++;
}
echo "</div>" ;
echo "<p></p>" ;
echo "<div> Nombre de résultat =".$i ;

}
}
unset($db);


?>
