<?php
session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Archers de Coueron</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	<!-- fontawesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link type="text/css" rel="stylesheet" href="css/style.css">
	<script language="JavaScript" src="js/sjs.js"></script>
	<script>
		function goEntree(){
	        if(event.keyCode==13){
	            goConnex();
	        }
		}
	    document.onkeydown =goEntree;

	</script>

</head>

<body scroll=yes>
  <div class="container">
    <div class="row">
      <div class="col-sm-2 d-none d-sm-block"><img src="/images/logo.jpg" class="img-fluid" /></div>
      <div class="col-sm-8">
        <h1>Archers de Coüeron</h1>
        <h2>Inscriptions saison 2021-2022</h2>
      </div>
      <div class="col-sm-2 d-none d-sm-block text-end"><img src="/images/cible.gif" class="img-fluid" /></div>
    </div>
  </div>
</div>
<div id="container">
<form name="myForm" action="authConnex.php" method="POST">

 	<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr><td>
	<table border="0" align="center">
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Entrez votre identifiant :</td></tr>
	<tr><td><input name="idUser" value="" maxlength="8" size="20" class="input0" onBlur="javascript:myForm.passWord.focus()"></td>
	<tr><td>Entrez votre mot de passe :</font></td></tr>
	<tr><td><input type="password" name="passWord" value="" maxlength="8" size="20" class="input0"><input type="hidden" name="passWord1"  value=""></td></tr>
	<tr><td>Mémoriser l'utilisateur :&nbsp;<input type="checkbox" class="cbL1" name="chkSauver" value="O" checked></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><img src="images/bt_connex.gif" alt="" border="0" onClick="javascript:goConnex();" style="cursor:pointer" title="Se connecter au ARchers CCoueronnais"></td></tr>
	</table>
	</td></tr>
	</table>
	</form>

</div>
<script>
myForm.idUser.value 	= getCookieInfo("user_pulsat")
myForm.passWord.value = getCookieInfo("pwd_pulsat")

if (myForm.idUser.value == ";"){
	myForm.idUser.value = ""
}
if (myForm.passWord.value == ";"){
	myForm.passWord.value = ""
}

if (myForm.idUser.value == ""){
	myForm.idUser.focus();
} else {
	myForm.passWord.focus();
}
</script>
</body>
</html>
