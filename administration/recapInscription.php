<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');

$arrayValueFixe  = array ("categories", "civilite", "prenom", "nom","dateNaissance","email1","telephone1","dossier","kit","lot","lateralite","remarque" ,"certificat", "debutant"  ,"chequeKit"  ,"chequeCotisation","groupe" ) ;
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
<link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<div class="row">
<div class="col-md-3 offset-md-1">
<form id='selectDossier' method='post'>
<label for="dossiers">Choisir dossier:</label>
</div>
<div class="col-md-auto">
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
// Categrorie
 
?>
</div>
<div class="row">
</div>
<div class="col-md-3 offset-md-1">
<label for="categories">Choisir categorie:</label>
</div>
<div class="col-md-auto">
<select name="Categories" id="Categories" size="1">
	<option value=-1 >tous</option>
	<option value=0  >poussin</option>
	<option value=1  >benjamin</option>
	<option value=2  >minime</option>
	<option value=3  >cadet</option>
	<option value=4  >jeune</option>
	<option value=5  >senior</option>
</select>
</div>
<div class="row">
</div>
<div class="col-md-3 offset-md-1">
 <!-- column filter -->
<label for="column">Choisir colonne a filtrer:</label>
</div>
<div class="col-md-auto">
<select name="column" id="column" size="1">

<?php
echo '<option value="vide">vide</option>' ;
foreach ($arrayValueFixe as $column)
{
		echo '<option value="'.$column.'">'.$column.'</option>' ;
}
echo '</select>' ;
?>
</div>
<div class="col-md-auto">
<label for="Like">inverser </label>
</div>
<div class="col-md-auto">
<input class="form-check-input" type="radio" name="notLike" class="checkbox" value='notLike' >
</div>
<div class="col-md-auto">
<input type="text" name="filterValue" >
<?php
// Sort
?>
</div>
<div class="row">
</div>
<div class="col-md-3 offset-md-1">
<label for="sort">Choisir colonne a trier:</label>
</div>
<div class="col-md-auto">
<select name="sort" id="sort" size="1">

<?php

foreach ($arrayValueFixe as $column)
{
		echo '<option value="'.$column.'">'.$column.'</option>' ;
}
echo '</select>' ;
echo '</div>' ;
echo '<div class="row">' ;
echo '<div col-md-3 offset-md-1">' ;
// submit
//echo '<input class="btn btn-success" type="submit" title="Validation filtre">';
echo "<input type='submit' class='green' name='validation' value='validation' form='selectDossier'>&nbsp";
echo '</div>';
echo '</div>';
echo '</div>';
echo '</form>';

if(isset($_POST['Dossier']))
{
$dossierSelected=$_POST['Dossier'] ;
$categorie=$_POST['Categories'];
if ($categorie == -1)
	$categorie = "%%" ;


$elementsFixe = "";
foreach($arrayValueFixe as $element)
{
if (empty($elementsFixe))
$elementsFixe =$element." ";
else
$elementsFixe =$elementsFixe.",".$element." ";
}

$elements = "";
foreach($arrayValue as $element)
{
$elements =$elements.",".$element." ";
}

$column=' ';

if(isset ($_POST ['column']) and isset ($_POST['filterValue'] ))
{
  if ($_POST['column'] != 'vide')
  {
		if(isset ($_POST['notLike']))
		$column = ' AND '.$_POST['column'].' not like "%'.$_POST['filterValue'].'%" ';
		else
    $column = ' AND '.$_POST['column'].' like "%'.$_POST['filterValue'].'%" ';
    //var_dump('valeur colonne '.$column);
  }
}


if(isset ($_POST ['sort']) )
{
  if (!empty($_POST['sort']))
  {
    $column =$column.' ORDER BY '.$_POST['sort'].' ASC ';
  //  var_dump('valeur colonne '.$column);
  }
}



if($dossierSelected == "tous")
{
 $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where categories like "'.$categorie.'"'.$column.';' ;
 $sqlEmail = 'SELECT   email1 ,email2 from adherents where categories like "'.$categorie.'"'.$column.';' ;
}
else if($dossierSelected == "vide")
{
	$sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where dossier IS NULL and categories like "'.$categorie.'"'.$column.';' ;
	$sqlEmail = 'SELECT  email1 ,email2 from adherents where dossier IS NULL and categories like "'.$categorie.'"'.$column.';' ;
  }
else
{
  $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where dossier = "'.$dossierSelected.'" and categories like "'.$categorie.'"'.$column.';' ;
  $sqlEmail = 'SELECT   email1 ,email2 from adherents where dossier = "'.$dossierSelected.'" and categories like "'.$categorie.'"'.$column.';' ;
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
<!-- resultat -->



<input  name='dossierSelected' value="<?php echo $_POST['Dossier']; ?>">
<input  name='Categories' value="<?php echo $_POST['Categories']; ?>">
<input  name='colonne' value="<?php echo $_POST['column']; ?>">
<input  name='filterValue' value="<?php echo $_POST['filterValue']; ?>">
<p> </p>


<style>
	.menu-fixe {  position:fixe;
	height: 30px;
      top: 0;
      right: 0;
      left: 0;}
    
	table,
	tbody,
	th ,
    td {
		text-align: center;
        padding: 4px;
        border: 1px solid black;
        border-collapse: collapse;
      }
	tr:nth-child(even) {
    background-color: #eee;
}
th {
background-color: #eee;
}
</style>
<div id="tableResultat" style="overflow:scroll;width:100%;height:650px">

<table >
<!--<thead> --> 
<tr>

<!--<tr>-->

<?php
// Entete de colonne
foreach ($arrayValueFixe as $element)
{
	echo '<th>' ;
	echo '<div class="menu-fixe"> '	;
//	echo '<th scope="col"> ' ;
//	echo "<label class='form-label'>".$element."</label> " ;
	echo "$element" ;
	echo '</div >'	;

	echo '</th> ' ;
}
foreach($arrayValue as $element)
{
//	echo '<th scope="col"> ' ;
	echo '<th> ' ;
	echo '<div class="menu-fixe"> '	;
	//echo "<label class='form-label'>".$element."</label> " ;
	echo "$element" ;
	echo '</div >'	;
	echo '</th> ' ;
}
echo '</tr>' ;
//echo '</thead>' ;

//echo '<tbody>' ;
// Dumpt DATA
while ($data = $req->fetch())
{
	echo '<tr>' ;
 foreach($arrayValueFixe as $element)
 {

	echo '<td>' ;
	//echo "<label class='form-label'>".$data[$element]."</label>" ;
	echo "$data[$element]" ;
	echo '</td>' ;
 }


foreach($arrayValue as $element)
{

	echo '<td>' ;
//	echo "<label class='form-label'>".$data[$element]."</label>";
	echo "$data[$element]";
	echo '</td>' ;

}
echo '</tr>' ;
}
//echo '</tbody>' ;

echo '</table>' ;
echo '</div>' ;
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
