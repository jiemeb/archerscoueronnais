<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');
 ?>

<?php


$arrayValueFixe  = array ("civilite" ,"prenom","nom", "licence",  "arcType", "blason", "depart" ,"concoursPrix") ;
// Valeur a éditer
$arrayValue= array();

if(isset($_SESSION['authorized']))
{

//-----------------------------------------------------------------------------//
// Display frame
//-----------------------------------------------------------------------------//
echo "<div> </div>";
if(isset($_SESSION['concoursSelected']))
{
// Display Concours information

$sqlConcour = "SELECT  concoursName, concoursDate,  prixEnfant, prixAdulte, referent, note  from concours where id_concours = ".$_SESSION['concoursSelected'];

$reqConcour = $db->query($sqlConcour) ;

while($data1 = $reqConcour->fetch()) 
{

echo "<div>";
echo "<table><tr><td>";
echo "<label class='form-label'> <b>concours </b> </label> <label class='form-label'>&nbsp ".$data1['concoursName']." "."</label>&nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Date </b> </label> <label class='form-label'>&nbsp".$data1['concoursDate']."</label> &nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Prix Enfants </b> </label> <label class='form-label'>&nbsp ".$data1['prixEnfant']."</label> &nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Prix Adulte </b> </label> <label class='form-label'>&nbsp".$data1['prixAdulte']."</label> &nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Référent </b></label> <label class='form-label'>&nbsp ".$data1['referent']."</label> &nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>note &nbsp</b></label><label class='form-label'>&nbsp ".$data1['note']."</label> &nbsp" ;
echo "</td></tr></table>";
echo "</div> <div> </div>";
} 

// display archer in concours
$elementsFixe = "";
foreach ($arrayValueFixe as $value)
{
	if(empty($elementsFixe))
		$elementsFixe = $value;
	else
		$elementsFixe = $elementsFixe.",".$value;
}
$elementsEditable = "";
foreach ($arrayValue as $value)
{
	$elementsEditable = $elementsEditable .",".$value;
}

$sqlConcoursArchers= "select ".$elementsFixe.$elementsEditable.",concoursPrix, dateNaissance, email1, email2  from concoursArchers as c,adherents as a where  c.id_adherent = a.id_adherent and c.id_concours =".$_SESSION['concoursSelected']." ORDER BY c.id_adherent" ;
// retrieve value for concours
$reqArcherConcours = $db->query($sqlConcoursArchers) ;
$data = $reqArcherConcours->fetchAll() ;



?>
<div>&nbsp</div>
<table >
<style>
      table,
      th,
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
<!--thead-->
<tr>
<?php
// Entete de colonne
{
	echo '<th>' ;
	echo "<label class='form-label'>categorie </label>" ;
	echo '</th>' ;
}
foreach ($arrayValueFixe as $element)
{
	echo '<th>' ;
	echo "<label class='form-label'> ".$element." </label>" ;
	echo '</th>' ;
}
foreach($arrayValue as $element)
{
	echo '<th>' ;
	echo "<label class='form-label'> ".$element." </label>" ;
	echo '</th>' ;
}
echo '</tr>' ;
//echo '</thead>' ;
//echo '<tbody>' ;
// Dump DATA
$i=0;
$concoursPrix = 0;
$mailArchersConcours = "";
foreach ($data as $dataCursor)
{
	//var_dump($dataCursor) ;
echo '<tr>' ;
{
	echo '<td>' ;
	echo "<label class='form-label'>".categorie($dataCursor['dateNaissance'])."</label>" ;
	echo '</td>' ;
 }

foreach($arrayValueFixe as $element)
 {
	echo '<td>' ;
	echo "<label class='form-label'>".$dataCursor[$element]."</label>" ;
	echo '</td>' ;
 }
foreach($arrayValue as $element)
{
	echo '<td>' ;
	echo "<label class='form-label'>".$dataCursor[$element]."</label>";
	echo '</td>' ;
}
echo '</tr>' ;
// I could get email1, email2, prenom, nom from row here !!
if (isset ($dataCursor['email1']) )
{	
	$mailArchersConcours = $mailArchersConcours .$dataCursor['email1'] ."," ;

}
if (strlen($dataCursor['email2'])!= 0 )
{	
	$mailArchersConcours = $mailArchersConcours .$dataCursor['email2'] ."," ;
}
$concoursPrix = $concoursPrix + $dataCursor['concoursPrix'] ;
$i=$i+1 ;

}
echo '<tr></tr>' ;
//echo '</tbody>' ;
echo '</table>' ;

echo "<div>&nbsp </div>";
echo "Prix du concours = ". $concoursPrix ;
echo "<div>&nbsp </div>";

echo '<input type="button" class="green" value="gestion Concours" onClick="window.location.href=\'gestionConcours.php\'">';
echo '<input type="button" class="green" value="modification Concours"  onClick="window.location.href=\'modificationConcours.php\'">';
echo "<div>&nbsp </div> <div>&nbsp  </div>";

//--------------------------------------------
// Get Mail for every archer and mail for all
//--------------------------------------------
?>

<h3> Mail archers dans le concours </h3>
<div>&nbsp</div>
<?php echo $mailArchersConcours ; ?>

<div>&nbsp</div>
<h3> Archers dans le concours </h3>
<div>&nbsp</div>
<table >
<style>
      table,
      th,
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
<!--thead-->
<tr>
<?php
// Entete de colonne
{
	echo '<th>' ;
	echo "<label class='form-label'>prenom </label>" ;
	echo '</th>' ;

	echo '<th>' ;
	echo "<label class='form-label'> nom </label>" ;
	echo '</th>' ;

	echo '<th>' ;
	echo "<label class='form-label'>email1 </label>" ;
	echo '</th>' ;

	echo '<th>' ;
	echo "<label class='form-label'>email2 </label>" ;
	echo '</th>' ;

}
echo '</tr>' ;
//echo '</thead>' ;
//echo '<tbody>' ;

foreach ($data as $dataCursor)
{
	echo "<tr>";
	echo "<td>".$dataCursor['prenom']."</td><td> ".$dataCursor['nom']."</td><td> ".$dataCursor['email1']."</td><td> ".$dataCursor['email2']." </td>";
	echo "</tr>";
}

echo '<tr></tr>' ;
//echo '</tbody>' ;
echo '</table>' ;


//-------------------------------------------------------



// Etat paiement archer
$arraypaiement = array ("prenom" , "nom" ,  "email1", "email2", "doit") ;
$sqlConcoursArchers= "select prenom , nom ,  email1, email2, sum(concoursPrix) as doit  from concoursArchers as c,adherents as a where  c.id_adherent = a.id_adherent and etat IS NULL  GROUP BY c.id_adherent ORDER BY c.id_adherent" ;
// retrieve value for concours
$reqArcherConcours = $db->query($sqlConcoursArchers) ;
$data = $reqArcherConcours->fetchAll() ;
?>
<div>&nbsp</div>
<h3> Gestion comptable concours </h3>	
<div>&nbsp</div>
<table >
<style>
      table,
      th,
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
<!--thead-->
<tr>
<?php
// Entete de colonne

foreach($arraypaiement as $element)
{
	echo '<th>' ;
	echo "<label class='form-label'> ".$element." </label>" ;
	echo '</th>' ;
}
echo '</tr>' ;
//echo '</thead>' ;
//echo '<tbody>' ;

// Dump DATA
$i=0;

foreach ($data as $dataCursor)
{
	//var_dump($dataCursor) ;

foreach($arraypaiement as $element)
 {
	echo '<td>' ;
	echo "<label class='form-label'>".$dataCursor[$element]."</label>" ;
	echo '</td>' ;
 }

echo '</tr>' ;
$i=$i+1 ;

}
echo '<tr></tr>' ;
//echo '</tbody>' ;
echo '</table>' ;



}


unset($db) ;
}

function categorie ( $dateNaissance)
{

	//var_dump ($dateNaissance);

	$dateF= new DateTime ('2025-12-31');
	$dateN =  new DateTime($dateNaissance) ;


	$age = $dateN->diff($dateF);
	$year = $age->y ;
 //   var_dump( $year);
	if ($year < 11)
		$categorieFederale = "U11";
	elseif ($year < 13) {
			$categorieFederale = "U13";
		}elseif ($year < 15) {
				$categorieFederale = "U15";
			}elseif ($year < 18) {
					$categorieFederale = "U18";
				}elseif ($year < 21) {
							$categorieFederale = "U21";
					}elseif ($year < 40) {
								$categorieFederale = "S1";
						}elseif ($year < 60) {
									$categorieFederale = "S2";
								}else {
										$categorieFederale = "S3";
										}
	return $categorieFederale ;
}
?>
