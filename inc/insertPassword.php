<?php

session_start();
include("connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Nouvel utilisateur</title>
<style>
</style>
</head>
<body>

<h1>Nouvel utilisateur</h1>
		<form name="form" method="post" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'; >
		<p><label for="login">Utilisateur </label> <input type="text" title="Saisissez votre nom" name="login" /></p> 
        <p><label for="password"  >Mot de passe          </label> <input type="password" title="Saisissez le mot de passe" name="password" /></p> 
        <p><label for="rePassword">Confirmer mot de passe</label> <input type="password" title="re-saisissez le mot de passe" name="passwordAgain" /></p> 
		<p><input type="submit" name="submit" value="Nouvel utilisateur" />
        <a href="../validAuthorized.php"> <input type=button value=retour /> </a>
        </p> 
		</form>

<?php

// stockage du hash du mot de passe
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordAgain']))
{
$password = $_POST['password'];
if ($password != $_POST['passwordAgain'])
    {
        echo 'mot de passe différent';
    } else  {

    $login=$_POST['login'];

    $query  = sprintf("INSERT INTO users(id_user,mot_passe,authorized) VALUES('%s','%s',%1s);",
    htmlspecialchars($login),
            password_hash($password, PASSWORD_DEFAULT),
            "0");

    $result = mysqli_query($connexion, $query); 
    $_SESSION['login']=$login ;
    }
}
else {
    echo 'remplir tous les champs SVP';
}
?>
