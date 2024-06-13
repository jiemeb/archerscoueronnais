<?php

header('Cache-Control:private, no-store, must-revalidate');header('Content-Language: fr');header('Vary: Accept-Encoding');header('X-Frame-Options: SAMEORIGIN');header('X-Robots-Tag: noindex,nofollow,noarchive');header('X-XSS-Protection: 1; mode=block');header('X-UA-Compatible: IE=edge, chrome=1');header('Content-Type: text/html; charset=utf-8');ob_start('ob_gzhandler');

/** Nouvelle fonction mail pour le FAI Free, conforme au standard
 * De temps en temps les courriels ne sont pas envoyés, mais pourtant la fonction mail() renvoie True
 * ce qui n'est pas conforme a la spécification PHP de cette fonction.
 * De manière empirique, il a été déterminée qu'un temps d'envoi au moins égal à 2 secondes est une garantie que le courriel
 * est vraiment envoyé.
 * Si le mail est vraiment envoyé, une notification de rejet est bien envoyé par Free à l'adresse de l'expéditeur du message
 * Copyright 2013 - a@a.a <tmp12311@free.fr>
 * Licence : CeCILL-B, http://www.cecill.info
 * Merci à Gaming Zone <http://gaming.zone.online.fr> pour ses tests ayant permis de déterminer la durée
 * */
function mailFree($to , $subject , $message , $additional_headers=null , $additional_parameters=null) {
	$start_time = time();
	$resultat=mail ( $to , $subject, $message, $additional_headers, $additional_parameters);
	$time= time()-$start_time;
	return $resultat & ($time>1);
}
/** Fin de la définition de la fonction*/
 
 
/** Le code qui suit est juste donné comme exemple de test de la fonction
 *
 * Code de test de la fonction
 * Modifié par Al <les.pages.perso.chez(chez)free.fr>
 * Styles CSS basés sur le projet Better Web Readability Project CSS Library <http://code.google.com/p/better-web-readability-project/>
 *  */
 
/* Mettre ici l'adresse mail de votre site Web : si votre site est http://monsite.free.fr/ alors votre adresse email est monsite@free.fr */
$admin = 'Moi <archerscoueronnais@free.fr>';
$port = 25 ;
ini_set('SMTP_PORT',$port);

$outHead = '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<title>Test de la fonction PHP mail() chez Free - Test d\'envoi</title><meta name="robots" content="noindex,nofollow,noarchive"/><style media="all" type="text/css">html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td { margin: 0; padding: 0; border: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align: baseline; } table { border-collapse: separate; border-spacing: 0; } caption, th, td { text-align: left; font-weight: normal; } table, td, th { vertical-align: middle; } blockquote:before, blockquote:after, q:before, q:after { content: ""; } blockquote, q { quotes: "" ""; } a img { border: none; } body { margin: 10px; } body { font:1em/1.625em \'lucida grande\',\'lucida sans unicode\', sans-serif; background-color:#FFF; font-size-adjust:none; font-style:normal; font-variant:normal; font-weight:normal; } p { padding:0 0 0.8125em 0; color:#111; font-weight:300;} /* p + p { text-indent:1.625em;} */ p.first:first-letter{ float:left;font-family: baskerville,\'palatino linotype\',serif;font-size:3em;font-weight:700;line-height:1em;margin-bottom:-0.2em;padding:0.2em 0.1em 0 0; } p img { float: left; margin: 0.5em 0.8125em 0.8125em 0; padding: 0; } p img.right { float: right; margin: 0.5em 0 0.8125em 0.8125em } h1,h2{ font-weight:normal; color: #333; font-family:Georgia, serif; } h3,h4,h5,h6 { font-weight: normal; color: #333; font-family:Georgia, serif; } h1 { font-size: 2.125em; margin-bottom: 0.765em; } h2 { font-size: 1.9em; margin-bottom: 0.855em; } h3 { font-size: 1.7em; margin-bottom: 0.956em; } h4 { font-size: 1.4em; margin-bottom: 1.161em; } h5,h6 { font-size: 1.313em; margin-bottom: 1.238em; } input { font:1em/1.625em \'lucida grande\',\'lucida sans unicode\', sans-serif; border:none; color: #EEE; margin-bottom: 0.765em; text-decoration: none; padding:0.8125em;background: #333;} ul{list-style-position:outside;} li ul, li ol { margin:0 1.625em; } ul, ol { margin: 0 0 1.625em 0; margin-left:1.625em;} dl { margin: 0 0 1.625em 0; } dl dt { font-weight: bold; } dl dd { margin-left: 1.625em; } a { color:#005AF2; text-decoration:none; } a:hover { text-decoration: underline; } table { margin-bottom:1.625em; border-collapse: collapse; } th { font-weight:bold; } tr,th,td { margin:0; padding:0 1.625em 0 1em; height:26px; } tfoot { font-style: italic; } caption { text-align:center; font-family:Georgia, serif; } abbr, acronym { border-bottom:1px dotted #000; } address { margin-top:1.625em; font-style: italic; } del {color:#000;} blockquote { padding:1em 1em 1.625em 1em; font-family:georgia,serif;font-style: italic; } blockquote:before { content:\'\201C\';font-size:3em;margin-left:-.625em; font-family:georgia,serif;color:#aaa;line-height:0;}/* From Tripoli */ blockquote > p {padding:0; margin:0; } strong { font-weight: bold; } em, dfn { font-style: italic; } dfn { font-weight: bold; } pre, code { margin: 1.625em 0; white-space:pre;white-space:pre-wrap;word-wrap:break-word } pre, code, tt { font-family: monospace; line-height: 1.5; white-space:pre;white-space:pre-wrap;word-wrap:break-word } tt { display: block; margin: 1.625em 0; } hr { margin-bottom:1.625em; } .oldbook { font-family:\'Warnock Pro\',\'Goudy Old Style\',\'Book Antiqua\',\'Palatino\',Georgia,serif; } .note { font-family:Georgia, \'Times New Roman\', Times, serif; font-style:italic; font-size:0.9em; margin:0.1em; color:#333; } .mono { font-family:\'Courier New\', Courier, monospace;white-space:pre;white-space:pre-wrap;word-wrap:break-word }</style><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head><body style="margin-left:auto;margin-right:auto;width:70%">
<h1>Test de la fonction PHP <span class="mono">mail()</span> chez Free - Test d\'envoi</h1><hr/>
<p>L\'appel &agrave; la fonction <span class="mono">mail()</span> sera r&eacute;alis&eacute; lors de la validation du formulaire</p>
<p>Pensez &agrave; supprimer cette page une fois vos op&eacute;rations de maintenance termin&eacute;es.</p>
<hr/>
<h3>Erreur(s) d&eacute;tect&eacute;e(s)&nbsp;:</h3>';
$out='';
$res=false;
 
if (empty($_POST)||isset($_POST['reset'])){
	$dest='';
} else {
	$dest='destinataire<'.$_POST['dest'].'>';
	if (isset($_POST['send'])){
		$sujet='Message envoyé le '.date("l j F Y").' à '.date("H:i:s").', Test numéro 1';
		$message="Ma foi,\nTout semble fonctionner correctement.\n\nEnvoyé depuis l'IP={$_SERVER["REMOTE_ADDR"]}";
		$additional_headers = "Cc: $admin\r\n";
        $additional_headers .= "From: $admin\r\n";
		$additional_headers .= "MIME-Version: 1.0\r\n";
		$additional_headers .= "Content-Type: text/plain; charset=utf-8\r\n";
		// $additional_headers .="Reply-To: $admin\r\n";
		$additional_headers .="Return-Path: $admin\r\n";
 
		if (mailFree( $dest, $sujet , $message, $additional_headers )==false) {
			$out.="<pre style='border: 1px dotted #666666;padding:10px;'><code>L'envoi du message n'a pas été réalisé en raison des limitations des serveurs de Free, merci de réessayer un peu plus tard.</code></pre>";
		} else {$res=true;}
	}
}
 
 
if (!$res) {
	$out.="<form id='contact' method='post'>
   	<p><strong>Tous les champs sont obligatoires.</strong></p>
		 <p style='display:inline-block'><label for='dest'>Courriel pour la réponse&nbsp;:</label>&nbsp;<input type='text' name='dest' id='dest' value='$dest'/></p>
            <p style='display:inline-block'><input type='reset' name='reset' value='Effacer'/>&nbsp;<input type='submit' name='send' value='Envoyer'/></p>
        </form>";
	} else {
		$out.="<pre style='border: 1px dotted #666666;padding:10px;'><code>Merci de votre visite, vous allez recevoir un message à l'adresse&nbsp;: $dest</code></pre>";
	}
$outForm='<p>Si une erreur du serveur ou un warning du type <span class="mono"><strong>Warning:</strong> mail() [function.mail]: Trop de spam. Fonction mail() bloqu&eacute;e. in <strong>/mnt/000/xxx/x/0/votrelogin/test-mail.php</strong> on line <strong>17</strong></span> appara&icirc;t dans la zone de notification, la fonction PHP <code>mail()</code> de votre compte est bloqu&eacute;e pour spam ou usage excessif. Selon les cas, la fonction PHP <code>mail()</code> sera d&eacute;bloqu&eacute;e automatiquement toutes les fins de semaines ou de temps en temps.</p>
<p>Si il n\'appara&icirc;t dans la zone de notification aucun warning ou message d\'erreur, la fonction PHP <span class="mono">mail()</span> de votre compte fonctionne correctement.</p>
<p>Des informations additionnelles sont disponibles dans le billet <a href="http://les.pages.perso.chez.free.fr/index.php/post/2007/06/19/Lart-et-la-maniere-denvoyer-des-mails-depuis-les-pages-perso-de-Free" hreflang="fr" title="L\'art et la mani&egrave;re d\'envoyer des mails depuis les pages perso de Free…">L\'art et la mani&egrave;re d\'envoyer des mails depuis les pages perso de Free…</a> du site <em>Les Pages Perso Chez Free</em>.</p></body></html>';
 
echo $outHead.$out.$outForm;
 
ob_end_flush();
?>
