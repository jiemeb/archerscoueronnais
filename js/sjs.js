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
		clearCookie();
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
document.cookie = "user_archer="+myForm.idUser.value+"; expires=" + expire.toGMTString();
document.cookie = "pwd_archer="+myForm.passWord.value+"; expires=" + expire.toGMTString();
}

function clearCookie(){
	document.cookie = "user_archer="+myForm.idUser.value+"; expires=Thu, 01 Jan 1970 00:00:01 GMT";
	document.cookie = "pwd_archer="+myForm.passWord.value+"; expires=Thu, 01 Jan 1970 00:00:01 GMT";
	}