<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexion.php');
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
$reqDossier = mysqli_query($connexion,$sqlDossier) ;


?>
<form id='selectDossier' method='post'>
<select name="Dossier" size="1">
<?php
while ($rowDossier = mysqli_fetch_assoc($reqDossier))
{
echo '<option value="'.$rowDossier['dossier'].'">'.$rowDossier['dossier'].'</option>' ;

}
echo '</select>' ;
echo "<input type='submit' value='submit' form='selectDossier'>";
echo '</form>';

if(isset($_POST['Dossier']))
{
$dossierSelected=$_POST['Dossier'] ;

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
if(empty($dossierSelected))
{
 $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents ;' ;
}
else
{
  $sql = "SELECT   ".$elementsFixe.$elements. 'from adherents where dossier = "'.$dossierSelected.'";' ;
}
//var_dump ($sql);
$req = mysqli_query($connexion,$sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<!--<input type='hidden' name='dossierSelected' value="<?php echo $dossierSelected; ?>">-->
<input  name='dossierSelected' value="<?php echo $dossierSelected; ?>">


<div class='container'>
  <div class='row'>
    <div class='col'>

<!-- <form  method='post' id='formulaire'> -->

<?php
while ($data = mysqli_fetch_assoc($req))
{

$i=0;

 foreach($arrayValueFixe as $element)
 {
	 if (!($i%6))
	 {
     echo "</div>";
		   echo "<div class='row'>";
	 }

 $i++;
echo "<div class='col-md'>";
echo "	<div class='mb-2'>";
echo "<label class='form-label'>".$element."= </label>" ;
echo  " ".$data[$element] ;
echo "	</div> ";
echo "</div> ";
 }


$i=0;
foreach($arrayValue as $element)
{
	if (!($i%6))
	{
    echo "</div>";
		echo "<div class='row'>";
	}

$i++;
echo'		<div class="col-md">';
echo'					<div class="mb-2"> ';
echo "<label class='form-label'>".$element."</label>" ;
echo "<input type='text' name=".$element." id='".$element."' class='form-control' value= ".$data[$element]." >";
echo'					</div> ';
echo'		</div> ';

}
echo "</div>" ;
echo "<div class='row'>";

}
}

}

mysqli_close($connexion);


?>
