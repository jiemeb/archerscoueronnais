<?php
session_start(); 
if(isset(!$_SESSION['authorized']))
{
if (isset($_SESSION['count']) && ($_SESSION['count'] > 4)) {
	header('Location: http://www.google.com/');
} else {
?> 

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Texte</title>
<style>
</style>
</head>
<body>
	<?php
$query = sprintf("SELECT pwd FROM users WHERE name='%s';",
pg_escape_string($username));
$row = pg_fetch_assoc(pg_query($connection, $query));

if ($row && password_verify($password, $row['pwd'])) {
echo 'Bonjour, ' . htmlspecialchars($username) . '!';
} 
else {
echo 'L\'authentification a échoué pour ' . htmlspecialchars($username) . '.';
}



	if ((isset($_POST['password']) && ($_POST['password'])) != $password) {
		if (!isset($_SESSION['count'])) {
			$_SESSION['count'] = 0;
		} else {
			$_SESSION['count']++;
		}
	?> 
<h1>Connexion</h1>
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
<p><label for="password">Mot de passe</label> <input type="password" title="Saisissez le mot de passe" name="password" /></p> 
<p><input type="submit" name="submit" value="Connexion" /></p> 
</form>

<?php
	} else { ?> 
<p>Voici le texte.</p>
<?php 
	}
} 
}

?>
</body>
</html>