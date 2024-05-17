<?php
session_start();


//include("css/styleResultat.css");
//include("css/style.css");


include("inc/entete.php");
?>

   <link type="text/css" rel="stylesheet" href="css/styleResultat.css" media="screen"/>
  <link type="text/css" rel="stylesheet" href="css/styleResultatPrint.css" media="print"/>


</head>



  <div class="col mb-5 mt-5">
  	<a href="remerciement.php" class="btn btn-secondary">finalisation<i class="fas fa-angle-right"></i></a>
  </div>


<hr>

<div id="divToPrint" style="display:block;">
<embed src=http://archerscoueronnais.free.fr/doc/Règlement.pdf width=800 height=500 type='application/pdf'/>

</div>
