<?php
session_start();


include("inc/entete.php");


?>
	<link type="text/css" rel="stylesheet" href="css/styleResultat.css" media="screen"/>
	<link type="text/css" rel="stylesheet" href="css/styleResultat.css" media="print"/>


   <!--   popupWin.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><body onload="window.print()">' + divToPrint.innerHTML + '</html>'); -->


<script langage="javascript">
   function PrintDiv() {
      var divToPrint = document.getElementById('divToPrint');
      var popupWin = window.open('', '_blank', 'width=600,height=800');
      popupWin.document.open();
	  popupWin.document.write('<html><body   onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
      popupWin.document.close();
           }
</script>

<script language="javascript">
function PrintMe(DivID) {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";
   var content_vlue = document.getElementById(DivID).innerHTML;
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">');
   docprint.document.write('<head><title>My Title</title>');
   docprint.document.write('<style type="text/css">body{ margin:0px;');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()">');
   docprint.document.write(content_vlue);
   docprint.document.write('</body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>

</head>


	<body lang="fr-FR" link="#000080" vlink="#800000" dir="ltr">

<!--Bouton -->
<div id=noprint>
<span><br><br>
  <!--<input class="btn btn-success"  value="Impression" title="Impression" onclick='PrintDiv();'> -->
  <input class="btn btn-success"  value="Impression" title="Impression" onclick='PrintMe("divToPrint");'>
  <span><br> Imprimer le document en utilisant le <b>"bouton Impression"</b>. <br>
    mettre en option d'impression: <br><b>"mode portrait ,2 pages par feuille -et- Recto-verso bord court"</b> <br>
  Signer le document et nous le faire parvenir par courrier ou par mail ou de la main à la main lors de notre rendez-vous
   </span>
</div>
<div id=noprint>
	<br>
  <div class="col mb-5 mt-5">
    <a href="reglement.php" class="btn btn-secondary">Suivant<i class="fas fa-angle-right"></i></a>
  </div>
</div>


<!--Page 1 -->
<div id="divToPrint" >




<!--    <div id="Section1" dir="ltr" gutter="19" style="column-count: 1"><p style="margin-bottom: 0cm; line-height: 100%"> -->
      <div id="Section1" dir="ltr" gutter="19" style="column-count: 1"><p style="margin-bottom: 0cm; line-height: 100%">
		<br/>
		</p>
		<table align="center" class=cel width="467" cellpadding="0" cellspacing="0" style="page-break-before: auto; page-break-after: auto; page-break-inside: auto;background: transparent; border-top: 2px double ; border-bottom: 2px double ; border-left: 2px double ; border-right:2px double">

      <tr valign="top" class="cel-background">
        <td width="164"  class="cel"><p align="center" style=" margin-top: 0.14cm">
        <b>Categories</b></p>
        </td>
        <td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
        <b>age en 2025</b></p>
        </td>
        <td width="135" class="cel"><p align="center" style=" margin-top: 0.14cm">
          <b>Prix cotisation</b></p>
        </td>
      </tr>
				<tr valign="top">
					<td width="164" class="cel"><p align="center" style=" margin-top: 0.14cm">
					<b>Poussins						</b></p>
					</td>
					<td width="168" class="cel"><p align="center" style="margin-top: 0.14cm">
					<b>moins de 11 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style=" margin-top: 0.14cm">
					<b><?php echo $license[0]."€" ?></b></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="164" class="cel"><p align="center" style="margin-top: 0.14cm">
						<b>Benjamins</b></p>
					</td>
					<td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>11 et 12 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b><?php echo $license[1]."€" ?></b></p>
					</td>
				</tr>
				<tr valign="top">
					<td width="164" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>Minimes</b>
						</p>
					</td>
					<td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>13	et 14 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b><?php echo $license[2]."€" ?></b></p>
					</td>
				</tr>
        <tr valign="top">
					<td width="164" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>Cadets</b>
						</p>
					</td>
					<td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>15	à 17 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b><?php echo $license[3]."€" ?></b></p>
					</td>
				</tr>
        <tr valign="top">
					<td width="164" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>Juniors</b>
						</p>
					</td>
					<td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>18 à 20 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style= margin-top: 0.14cm">
						<b><?php echo $license[4]."€" ?></b></p>
					</td>
				</tr>
        <tr valign="top">
					<td width="164" class="cel"><p align="center" style=" margin-top: 0.14cm"  >
						<b>Seniors</b>
						</p>
					</td>
					<td width="168" class="cel"><p align="center" style=" margin-top: 0.14cm">
						<b>plus de 20 ans</b></p>
					</td>
					<td width="135" class="cel"><p align="center" style="margin-top: 0.14cm">
						<b><?php echo $license[5]."€" ?></b></p>
					</td>
				</tr>
		</table>
<hr>
    <h2 align="center" style="margin-top: 0.13cm" >
    		<font color="#ffffff"><span   style="background: #231f20">Droit à l'image</span></font></h2>

<div>
  <label>Je soussigné<?php if ($_SESSION['civilite'] == 'Madame') echo 'e'; echo ' '.$_SESSION['nom']." ".$_SESSION['prenom'].'<br><br>'; if ($_SESSION['droitimageClub'] == 'oui') echo '&nbsp; Accepte'; else echo "&nbsp; N'accepte pas " ;?> que moi-même soit pris en photo ou vidéo dans le cadre d’activités sportives
    de l’ESC Tir à l’Arc de Couëron, ou lors des sorties en compétition organisées par celui-ci.<br>
<?php if ($_SESSION['droitimagePress'] == 'oui') echo '&nbsp; Autorise'; else echo "&nbsp; N’autorise pas"; ?>  que l’ESC Tir à l’Arc de Couëron, la ville de Couëron et les quotidiens régionaux à utiliser ces images pour illustrer d’éventuels articles, bulletins, plaquettes, expositions, affiches ou diaporama le représentant.
<br>&nbsp; Je déclare en outre n’intenter aucun recours, ni réclamations, aucune demande de dédommagement envers la Ville de Couëron, ni envers l’ESC Tir à l’Arc de Couëron, ni envers les personnes qui exploiteraient ces images.
<br>Fait à : . <br> Le: <br>Signature de l'archer :.........Signature du représentant légal <br><br><br><br>
</label></div>
<hr>
<!--- page 2 -->

		<div style="page-break-before: always; page-break-after: auto; page-break-inside: auto" align="center">
    <img src="images/dossierInscriptionLogo.png" name="Forme2" alt="Forme2"  text-align="center" />
	<br>
    <h2 style="margin-left: 0cm; text-indent: 0cm; margin-top: 0.13cm">
    		<font color="#ffffff"><span text-align="center" style="background: #231f20">SAISON <?php echo $annee__fede -1 . "-" . $annee__fede ;?></span></font></h2>
  <LABEL> <h2>ÉTOILE SPORTIVE COUËRONNAISE, association depuis 1910.</h2><br><br>
Extrait de l’article 6 des statuts : «L’association est affiliée aux Fédérations Sportives Nationales régissant les sports qu’elle pratique, ainsi qu’à la Ligue Française de l’Enseignement et de l’Éducation permanente, et par la suite à l’Union Française des Œuvres d’Éducation Physique (UFOLEP) exception faite pour la section Athlétisme qui reste affiliée à la F.S.G.T»
C’est donc un club Multisports qui comprend des sections :<br>
<strong>ATHLÉTISME -BASKET-BALL - CANOË KAYAK - FOOTBALL - HANDBALL MULTISPORTS - NATATION - PÉTANQUE - SWIN GOLF - TENNIS - TIR À L’ARC</strong><br>
UNE SEULE COTISATION POUR PLUSIEURS ACTIIVITÉS<br>
<br>

Site web ESC	escoueron.org
<br>
Contacts ESC	 Didier Ménard<br>
 &nbsp; &nbsp; &nbsp; &nbsp; Vincent Froger	vfroger@laposte.net    </LABEL>
<br>
</div>
<hr>
<!--- page 3 -->
<h2 style="page-break-before: always; page-break-after: auto; page-break-inside: auto" >
		<font color="#ffffff"><span  align="center" style="background: #231f20">DEMANDE	D’INSCRIPTION À LA SECTION TIR A L’ARC	</span></font></h2>
<div >
  Nom : <?php echo $_SESSION['nom']."<br>" ;?>
  Prénom : <?php echo $_SESSION['prenom']."<br>"; ?>
  Date de naissance : <?php echo $_SESSION['dateNaissance']."<br>"; ?>
  Adresse : <?php echo $_SESSION['adresse']."<br>"; ?>
  Code postale : <?php echo $_SESSION['cp']." Ville ".$_SESSION['commune']."<br>"; ?>
  Téléphone : <?php echo $_SESSION['telephone1']." Téléphone ".$_SESSION['telephone2']."<br>"; ?>
  Email : <?php echo $_SESSION['email1']."<br>"; ?>
 <?php if (isset($_SESSION['email2']) )
    echo $_SESSION['email2']."<br>"; ?>
 <?php if ($_SESSION['nomRep1'] != '' )
 {
   echo "<br> pour les mineurs<br>";
   echo "Représentant légal: nom <strong>".$_SESSION['nomRep1']."</strong> prénom <strong>".$_SESSION['prenomRep1']."</strong><br>";
   if ($_SESSION['nomRep2'] != '')
  echo "Représentant légal: nom <strong>".$_SESSION['nomRep2']."</strong> prénom <strong>".$_SESSION['prenomRep2']."</strong><br>";
  ?>
  <h2  >
  		<font color="#ffffff"><span  align="center" style="background: #231f20">AUTORISATION PARENTALE - VALIDITÉ SAISON <?php echo $annee__fede -1 . "-" . $annee__fede ;?></span></font></h2>
<br>

<span>
  Pour un enfant mineur ou autorisation pour un incapable majeur<br>
<br>
  Madame, Monsieur,<br>
  Vous avez inscrit votre enfant à l’ESC Tir à l’Arc de Couëron pour la saison <?php echo $annee__fede -1 . "-" . $annee__fede ;?>, et nous vous en remercions.<br>
  Nous vous rappelons que la section n’est plus responsable de votre enfant en dehors des horaires et jours d’entraînement.<br>
  Durant cette année votre enfant peut être amené à participer à des concours.<br>
  Pour qu’il puisse être pris en charge pour son transport, par la section ou une autre famille, nous vous invitons à compléter et signer la décharge parentale ci-dessous.<br>
  Dans le cas contraire, votre enfant devra se rendre sur les différents lieux de rencontre par ses propres moyens.<br>
  Je soussigné (e), nom et prénom du représentant légal :  <?php  echo "<strong>".$_SESSION['nomRep1']." ".$_SESSION['prenomRep1']."</strong> " ?><br>
<br>
  Demeurant : <?php  echo "<strong>".$_SESSION['adresse']." ".$_SESSION['cp']." ".$_SESSION['commune']."</strong> " ?><br>
<br>
  Décharge l’ESC Tir à l’Arc de Couëron de toute responsabilité concernant l’enfant (nom- prénom) :<?php  echo "<strong>".$_SESSION['nom']." ".$_SESSION['prenom']."</strong> " ?><br>
  en dehors des lieux, jours et horaires d’entrainement.<br>
  Par la présente, je donne mon accord à l’ESC Tir à l’Arc de Couëron ou à l’un des accompagnateurs à transporter l’enfant, nommé ci-dessus, aux différentes compétitions.<br>
  En cas de blessure ou d’accident, j’autorise le responsable de la structure qui accueille, ou l’entraîneur à contacter les services d’urgences et à prendre les décisions qui s’imposent dans les plus brefs délais afin de faire face à toutes les situations.<br>
  Je note que je dois m’assurer de la présence du responsable d’entraînement au sein de la structure avant de laisser mon enfant. Je dois m’assurer que la séance d’entraînement a bien lieu (possibilité d’annulation pour intempéries ou raison de force majeure) et je m’engage à venir récupérer mon enfant ou incapable majeur en respectant les horaires qui m’ont été communiqués.<br>
<br>
  Fait à :  .... ...... ...... ..... ...... ...	le : . . . . . . . . . . . . . .<br>
<br>
  Signature du représentant légal :<br>

<br>
</span>
<?php
}else {
  echo "<br><br><br><br><br><br><br><br><br><br><br>";
}
?>

</div>

<hr>
<!--  page 4 -->
<h2  style="page-break-before: always ; page-break-after: auto; page-break-inside: auto"; align="center" >
		<font color="#ffffff"><span  text-align="center" style="background: #231f20">SAISON <?php echo $annee__fede -1 . "-" . $annee__fede ;?></span></font></h2>


  	<table width="100%" cellpadding="2" cellspacing="1" style="background: transparent; border-top: 2px double ; border-bottom: 2px double ; border-left: 2px double ; border-right:2px double; ">
			<col width="128*"/>
			<col width="128*"/>

			<tr valign="top" style="background: transparent;  border-top: 2px double ; border-bottom: 2px double ; border-left: 2px double ; border-right: 2px double ">
				<td width="50%" style="background: transparent;  border-top: 2px double ; border-bottom: 2px double  ; border-left: 2px double ; border-right: 2px double "><p >
					<b>Certificat	médical de moins 3 mois<br>DATE:______________</b>
      <br>&nbsp; </p>
				</td>
        <td rawspan rowspan="2" width="50%" style="border-top: 2px double ; border-bottom: 2px double ; border-left: 2px  ; border-right:2px double ;">
          <p style=margin-left: 0.25cm; margin-top: 0cm; margin-bottom: 0cm>
  					<b>ATTENTION IMPORTANT :</b>  votre certificat médical est nécessaire si  une des réponses est positive 
           au questionnaire médical.Questionnaire  que vous devez absolument remplir et conserver par devers vous.<b><u>
               Je déclare satisfaire au questionnaire médical QS-SPORT Cerfa N° 15699*01 que j’ai rempli et que je conserve par devers moi.</u></b><br><br>
                 <i>(Signature)<br><br></i>
                 <b>Couëron le :</b><br><br>
        					</p>
        </td>
      </tr>
        <tr valign="top" style="background: transparent; border-top: 2px double; border-bottom: 2px double ; border-left: 2px double ; border-right: 2px double">
          <td width="50%" style="border-top: 2px double ; border-bottom: 2px double; border-left: 2px double; border-right: 2px double "><p style="margin-left: 0.25 cm; margin-top: 0 cm; margin-bottom: 0cm">
  					<b>Questionnaire santé <br>DATE:______________</b>
        <br>&nbsp;</p>
  				</td>

			</tr>
	</table>
<hr>
<b> Pièce a fournir pour les mineurs: </b><br>Autorisation Parental <br>
Photocopie de la carte d'identité<br><br>
<hr>
<?php
echo "<br><br><br><br><table>";

$prix = 0;
if ($_SESSION['kit'] == 'oui') {echo("<tr><td>&ensp; Commande de Kit ................................</td><td>".$kit." €</td></td>");$prix += $kit ;}
if ($_SESSION['lot'] == 'oui') {echo("<tr><td>&ensp;       Commande de 3 flèches supplémentaires </td><td><u>".$lot." €</u></td></tr>");$prix += $lot ;}
if ($prix != 0)       {         echo ("<tr><td>            Total  fourniture optionnelle......................</td><td>".$prix." €</td></tr><br><br><br>") ;}
echo("<tr><td>Prix de la license  </td><td>".$license[$_SESSION['categories']]." €</td></tr></table>");$prix += $license[$_SESSION['categories']] ;
if ($prix != $license[$_SESSION['categories']])
echo "si vous faites une commande de kit faire si possible 2 chèques à l'ordre de l'<b>ESC archers de Coueron </b><br><br>";
else {
  echo "<br><br><br>";
}
 ?>
Je reconnais avoir pris connaissance des conditions de souscription d'une assurance complémentaire individuelle présentée ci-contre ainsi que du <b>règlement intérieur de la section présenté en page annexe.</b>
<br>
<br>
A:_______________________ Signature
<br>
<br>
<br>
<br>
<br>
<br>

</div>

</body>
</html>
