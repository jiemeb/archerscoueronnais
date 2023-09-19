<?php
session_start();
//$error=chdir ('/');
//getcwd()." ".$error .  "\n";
include(dirname(__FILE__).'/../inc/connexionPDO.php');
include(dirname(__FILE__).'/../inc/entete.php');

 ?>

<?php
$arrayValueFixe  = array ( "concoursName","ConcoursDate" ) ;
// Valeur a éditer
$arrayValue= array("referent", "note");

if(isset($_SESSION['authorized']))
{


// validation form concours

if (isset($_POST['validation']))
{
	// get modificaion concours
// Get nb enregistrement
$sql = "select id_concours from concours   ORDER BY ConcoursDate";    
$req = $db->query($sql);
try {
	$id_concours=$req->fetchAll();
	}
	catch (Exception $E)
	{
		echo 'Erreur SQL !<br>'.$sql.'<br>';
	}
// Foreach get variable index i
$i=0 ;
foreach ($id_concours as $concours)
{
	$elements = "";

	foreach($arrayValue as $element)
	 {
	 $v_intableau = $element.$i ;

		if(isset($_POST[$v_intableau]) && !empty($_POST[$v_intableau]) )
		{
			if(!empty($elements))      // Todo When empty make something to write NULL value
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
	
		$sql = "update  concours as c set ".$elements."  where id_concours  = ".$concours['id_concours']  ;
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
echo "<div></div>";


// display   concours
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

$sqlConcours= "select ".$elementsFixe.$elementsEditable.", sum(CASE when a.etat IS NULL THEN 1 Else 0 END ) AS non_payé from concours  as c,concoursArchers as a where  c.id_concours = a.id_concours  GROUP BY a.id_concours ORDER BY c.ConcoursDate" ;
//$sqlConcours= "select ".$elementsFixe.$elementsEditable.", sum(1 ) AS non_payé from concours  as c,concoursArchers as a where  c.id_concours = a.id_concours  GROUP BY a.id_concours ORDER BY c.ConcoursDate" ;

// retrieve value for concours
$reqConcours = $db->query($sqlConcours) ;


echo "<form id='FormConcours' method='post'>";

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
echo '<th>' ;
echo "<label class='form-label'>non_payé</label>" ;
echo '</th>' ;
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
while ($data = $reqConcours->fetch())
{
echo '<tr>' ;
foreach($arrayValueFixe as $element)
 {
	echo '<td>' ;
	echo "<label class='form-label'>".$data[$element]."</label>" ;
	echo '</td>' ;
 }
 
 echo '<td>' ;
 echo "<label class='form-label'>".$data['non_payé']."</label>" ;
 echo '</td>' ;

foreach($arrayValue as $element)
{
	echo '<td>' ;
//	echo "<label class='form-label'>".$data[$element]."</label>";
	echo "<input type='text' name=".$element.$i." id='".$element.$i."' class='form-control' value='".$data[$element]."' >";
	echo '</td>' ;
}
echo '</tr>' ;
$i=$i+1 ;

}
echo '</tbody>' ;
echo '</table>' ;
echo '</form>'  ;

echo "<div></div>";
echo "<input type='submit' class='red' name='validation' value='validation' form='FormConcours'>&nbsp";
echo '<input type="button" class="green" value="etat Concours" form="FormConcours" onClick="window.location.href=\'etatConcours.php\'">&nbsp';
echo '<input type="button" class="green" value="gestion Concours" form="FormConcours" onClick="window.location.href=\'gestionConcours.php\'">&nbsp';

}


unset($db) ;


?>
