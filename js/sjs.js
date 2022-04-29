/* Identification */
function goConnex() {
	if ( myForm.idUser.value == "") {
		alert("Entrez votre identifiant")
		myForm.idUser.focus();
		return;
	} 	
	if ( myForm.passWord.value == "") {
		alert("Entrez votre mot de passe")
		myForm.passWord.focus();
		return;
	} 	
	if (myForm.chkSauver.checked){
		goCookie();	
	} else {
		clearCookie()
	}

	myForm.submit();
}

function valFocus(){
	if (myForm.passWord.value.length == 8) {
		myForm.bok.focus();
	} else {
	}	
}

/* inscription identifiant dans un cookie */
function goCookie(){
var expire 			= new Date();
var unAn 				= expire.getTime() + (365*24*60*60*1000);
expire.setTime(unAn);
document.cookie = "user_pulsat="+myForm.idUser.value+"; expires=" + expire.toGMTString();
document.cookie = "pwd_pulsat="+myForm.passWord.value+"; expires=" + expire.toGMTString();
}


/* Sélection d'une APC */
function viewApc(){
	myForm.action 						= "view_apc.php";
	select 										= document.getElementById("list_apc");
	choice 										= select.selectedIndex;
	code_regate 							= select.options[choice].value;
	myForm.code_regate.value 	= code_regate;
	myForm.action.value 			= "ALL";
	myForm.submit();
}

/* Sélection d'une APC - Lien dans un tableau*/
function viewApcTable(id){
	myForm.action 						= "view_apc.php";
	myForm.code_regate.value 	= id;
	myForm.action.value 			= "ALL";
	myForm.submit();
}

/* Affichage des informations */
function viewData(id){
	myForm.action 				= "view_apc.php";
	if( id == -1 ){
		myForm.action.value = "ALL";
	}
	if( id == 0 ){
		myForm.action.value = "FIND_AGENT_CA";
	}
	if( id == 1 ){
		myForm.action.value = "FIND_CAF_PING";
	}
	if( id == 2 ){
		myForm.action.value = "FIND_CAF_STATUS";
	}
	if( id == 3 ){
		myForm.action.value = "FIND_CAMCFG";
	}
	if( id == 4 ){
		myForm.action.value = "FIND_CAMSTAT";
	}
	if( id == 5 ){
		myForm.action.value = "FIND_NETSTAT_CA";
	}
	if( id == 6 ){
		myForm.action.value = "FIND_NSLOOKUP";
	}
	if( id == 7 ){
		myForm.action.value = "FIND_PACKAGE_CA";
	}
	if( id == 8 ){
		myForm.action.value = "FIND_CARTE_RESEAU";
	}
	myForm.submit();
}

/* Affichage des informations ( Toutes les APC) */
function viewDataAll(id){
	myForm.action 				= "view_all_apc.php";
	if( id == 0 ){
		myForm.action.value = "FIND_AGENT_CA";
	}
	if( id == 1 ){
		myForm.action.value = "FIND_CAF_PING";
	}
	if( id == 2 ){
		myForm.action.value = "FIND_CAF_STATUS";
	}
	if( id == 3 ){
		myForm.action.value = "FIND_CAMCFG";
	}
	if( id == 4 ){
		myForm.action.value = "FIND_CAMSTAT";
	}
	if( id == 5 ){
		myForm.action.value = "FIND_NETSTAT_CA";
	}
	if( id == 6 ){
		myForm.action.value = "FIND_NSLOOKUP";
	}
	if( id == 7 ){
		myForm.action.value = "FIND_PACKAGE_CA";
	}
	if( id == 8 ){
		myForm.action.value = "FIND_CARTE_RESEAU";
	}
	myForm.submit();
}

/* Exportation Excel */
function doExcel(){
	myForm.action 				= "export.php";
	myForm.action.value 	= "ALL";
	myForm.submit();
}

function doExcelAll(){
	myForm.action 				= "export.php";
	myForm.action.value 	= "ALL_APC";
	myForm.submit();
}

/* Historique Signal de vie */
function viewHistoSignal(){
	myForm.action 				= "historique_signal.php";
	myForm.submit();
}

/* Afficher toutes les APC */
function viewAllApc(){
	myForm.action 				= "view_all_apc.php";
	myForm.action.value 	= "NO_SELECT";
	myForm.submit();
}

/* Exportation excel Historique Signal de vie */
function doExportSignal(){
	myForm.action 				= "export.php";
	myForm.action.value 	= "EXPORT_SIGNAL";
	myForm.submit();
}

/* Retour accueil */
function goIndex(){
	myForm.action 				= "view_apc.php";
	myForm.action.value 	= "ALL";
	myForm.submit();
}

/* Journal des traitements */
function viewLog(){
	myForm.action 				= "view_log.php";
	myForm.submit();
}
