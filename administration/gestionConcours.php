<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');

 ?>

<?php
$arrayValueFixe  = array ( "prenom","nom", "licence", "categories", "arcType"  ) ;
// Valeur a éditer
$arrayValue= array("blason", "depart", "concoursPrix","etat");

if(isset($_SESSION['authorized']))
{

if(isset($_POST['selectConcour']))
{
$_SESSION['concoursSelected'] = $_POST['concours'] ;
}

if (isset ($_POST['deleteConcours']) )
{
	unset ($_SESSION['concoursSelected']);
	$id = array ($_POST['concours']) ;
	$sqlDelete="delete from concoursArchers where id_concours=?";
	$db->prepare($sqlDelete)->execute($id);
	$sqlDelete="delete from concours where id_concours =?";
	$db->prepare($sqlDelete)->execute($id);
}

// remplisage  concours  
$sqlConcours = "SELECT   id_concours, concoursName  from concours order by concoursDate desc ;" ;
// on envoie la requête
$reqConcours = $db->query($sqlConcours) ;
// menu déroulant Concours
echo "<span class='form-label' >" ;
echo "<form id='selectConcours' method='post'>";
echo "<select name='concours' size='1'>";

while ($rowConcours = $reqConcours->fetch())
{
echo "<option value=".$rowConcours['id_concours'].">".$rowConcours['concoursName'].'</option>' ;
}
echo '</select>&nbsp' ;
echo "<input type='submit' name='selectConcour' value='Select concours' size='1' form='selectConcours'>&nbsp";
echo "<input type='submit' name='deleteConcours' value='Delete concours' form='selectConcours'>&nbsp";
//echo "<a href='creationConcours.php' input type='button'  value='Creation concours' form='selectConcours'>";
echo '<input type="button" value="Creation concours" form="selectConcours" onClick="window.location.href=\'creationConcours.php\'">&nbsp';
echo '<input type="button" value="Modification concours" form="selectConcours" onClick="window.location.href=\'modificationConcours.php\'">&nbsp';

echo '</form>';


// menu déroulant archers
$sqlArcher = "SELECT   id_adherent, prenom, nom from adherents order by dateNaissance desc ;" ;
$reqArcher = $db->query($sqlArcher) ;
echo "<form id='selectArcher' method='post'>";
echo "<select name='archer' size='1'>";
while ($rowArcher = $reqArcher->fetch())
{
$archerName=$rowArcher['prenom']." ".$rowArcher['nom'];
echo "<option value=".$rowArcher['id_adherent'].">".$archerName.'</option>' ;
}
echo '</select> &nbsp' ;
echo "<input type='submit' name='ajoutArcher' value='ajout Archer' form='selectArcher'>&nbsp";
echo "<input type='submit' name='suppressionArcher' value='Suppression Archer' form='selectArcher'>&nbsp";
echo '</form>';
echo "</span>" ;

if(isset($_SESSION['concoursSelected']))
{
if( isset($_POST['ajoutArcher']))
{
// Add archesrs to concours
	$sql = "insert into concoursArchers  ( id_adherent  ,id_concours ) VALUES ( ".$_POST['archer'].", ".$_SESSION['concoursSelected'].") " ;
	try {
		$req = $db->prepare($sql)->execute();
		}
		catch (Exception $E)
		{
			echo 'Erreur SQL !<br>'.$sql.'<br>';
		}
}

if( isset($_POST['suppressionArcher']))
{
// delete archesrs to concours
$sql = "delete from concoursArchers where   id_adherent =".$_POST['archer']." and id_concours =".$_SESSION['concoursSelected'] ;
try {
	$req = $db->prepare($sql)->execute();
	}
	catch (Exception $E)
	{
		echo 'Erreur SQL !<br>'.$sql.'<br>';
	}
}
// validation form archers

if (isset($_POST['validation']))
{
// Get nb enregistrement
$sql = "select id_adherent from concoursArchers  where  id_concours = ".$_SESSION['concoursSelected']." ORDER BY id_adherent";    
$req = $db->query($sql);
try {
	$id_adherents=$req->fetchAll();
	}
	catch (Exception $E)
	{
		echo 'Erreur SQL !<br>'.$sql.'<br>';
	}
// Foreach get variable index i
$i=0 ;
foreach ($id_adherents as $concoursAdherant)
{
	$elements = "";

	foreach($arrayValue as $element)
	 {
	 $v_intableau = $element.$i ;

		if(isset($_POST[$v_intableau]) && !empty($_POST[$v_intableau]) )
		{
			if(!empty($elements))
			{
				$elements=$elements.',' ;
			}
			$elements=$elements." ".$element."= :".$element;
	
			$data[$element]=$_POST[$v_intableau];
		}
		
	 }
	
		 if(!empty($elements))
		{
		
		try {
		$sql = "update  concoursArchers as c set ".$elements."  where id_concours  = ".$_SESSION['concoursSelected']." and c.id_adherent =".$concoursAdherant[0]  ;
		//var_dump ($sql) ;
		//var_dump($data);
		//var_dump($i) ;
		$req = $db->prepare($sql)->execute($data);
		unset($data);
		}
		catch (Exception $E)
		{
			echo 'Erreur SQL !<br>'.$sql.'<br>';
		}
		}// Update base
		$i++ ;
}
}
//-----------------------------------------------------------------------------//
// Display frame
//-----------------------------------------------------------------------------//
// Get rule of 3 concours free


$sqlFreeArchers= "select c.id_adherent, sum(CASE when c.etat = 'gratuit' THEN 1 Else 0 END ) AS nb_concours from concoursArchers  as c,adherents as a where  c.id_adherent = a.id_adherent AND (a.categories < 5 OR (categories = 5 AND debutant = 'OUI')) GROUP BY c.id_adherent ORDER BY c.id_adherent" ;
$reqFreeArchers = $db->query($sqlFreeArchers) ;
$freeArchers = $reqFreeArchers->fetchall();

//var_dump ($freeArchers) ;
//- populate concours
echo "<div></div>";
if(isset($_SESSION['concoursSelected']))
{
// Display Concours information

$prixConcoursAdulte = "";
$prixConcoursEnfant = "";

$sqlConcour = "SELECT  concoursName, concoursDate,  prixEnfant, prixAdulte, referent, note  from concours where id_concours = ".$_SESSION['concoursSelected'];
$reqConcour = $db->query($sqlConcour) ;


while($data1 = $reqConcour->fetch()) 
{

echo "<div>";
echo "<table><tr><td>";
echo "<label class='form-label'> <b>concours &nbsp</b></label> <label class='form-label'> ".$data1['concoursName']."</label>&nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Date &nbsp</b> </label><label class='form-label'>".$data1['concoursDate']."</label> &nbsp" ;
echo "</td><td>";
$prixConcoursEnfant =$data1['prixEnfant'] ;
echo "<label class='form-label'> <b>Prix Enfants &nbsp</b></label><label class='form-label'> ".$prixConcoursEnfant."</label> &nbsp" ;
echo "</td><td>";
$prixConcoursAdulte =$data1['prixAdulte'] ;
echo "<label class='form-label'> <b>Prix Adulte &nbsp</b> </label><label class='form-label'>".$prixConcoursAdulte."</label> &nbsp" ;
echo "</td><td>";
echo "<label class='form-label'> <b>Référent &nbsp</b></label><label class='form-label'> ".$data1['referent']."</label>&nbsp " ;
echo "</td><td>";
echo "<label class='form-label'> <b>note &nbsp</b></label><label class='form-label'> ".$data1['note']."</label> &nbsp" ;
echo "</td></tr></table>";
echo "</div><div></div>";
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

$sqlConcoursArchers= "select c.id_adherent,".$elementsFixe.$elementsEditable." from concoursArchers as c,adherents as a where  c.id_adherent = a.id_adherent and c.id_concours =".$_SESSION['concoursSelected']." ORDER BY c.id_adherent" ;
// retrieve value for concours
$reqArcherConcours = $db->query($sqlConcoursArchers) ;


echo "<form id='Archers' method='post'>";

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
$i=0;
$archerCategorie ="";
while ($data = $reqArcherConcours->fetch())
{
echo '<tr>' ;
$id_adherentConcours = $data['id_adherent']; // Get current id_adhrent in row

foreach($arrayValueFixe as $element)
 {

	if (!strcmp($element, "categories"))
		$archerCategorie = $data[$element] ;
	echo '<td>' ;
	echo "<label class='form-label'>".$data[$element]."</label>" ;
	echo '</td>' ;
 }

foreach($arrayValue as $element)
{
	echo '<td>' ;
//	echo "<label class='form-label'>".$data[$element]."</label>";

switch ($element)
	{

		case "etat"	 :
			$index_freeArchers =array_search ($id_adherentConcours,array_column($freeArchers,'id_adherent') );

			if(is_numeric($index_freeArchers) )
			{		

				if($freeArchers[$index_freeArchers]['nb_concours'] < 3)
					echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='gratuit' >";
				else
					echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$data[$element]."' >";
			}	
			else
				echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$data[$element]."' >";
			break ;
		case "concoursPrix"	:
			if	($archerCategorie < 5)
			echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$prixConcoursEnfant."' >";
			else
			echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$prixConcoursAdulte."' >";
			break;
		default:	
			echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$data[$element]."' >";


	}

	echo '</td>' ;
}
echo '</tr>' ;
$i=$i+1 ;

}
echo '</tbody>' ;
echo '</table>' ;
echo '</form>'  ;
}
echo "<div></div>";
echo "<input type='submit' class='red' name='validation' value='validation' form='Archers'>&nbsp";
echo '<input type="button" class="green" value="etat Concours" form="selectConcours" onClick="window.location.href=\'etatConcours.php\'">';

}


unset($db) ;
}

?>
