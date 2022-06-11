<?php
session_start();
include("inc/connexion.php");
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
	if(isset($_SESSION['authorized'])!= true)
	{
		if (isset($_SESSION['count']) && ($_SESSION['count'] > 4)) {
			header('Location: http://www.google.com/');
		} 
		else 
		{
			
	if(isset($_POST['login']) && isset ($_POST['password']) )
		{
			$_SESSION['login']= htmlspecialchars($_POST['login']);
			
		}	

	if ( isset ($_SESSION['login']))
		{
		$login = $_SESSION['login']	;	

		$query = sprintf("SELECT mot_passe,authorized FROM users WHERE id_user='%s' ;",$login);
		$row = mysqli_fetch_assoc(mysqli_query($connexion, $query));

		if ($row && password_verify($_POST['password'], $row['mot_passe'])) {
			if($row['authorized'] != "0")
			{
				$_SESSION['authorized'] = true ;
				echo "Utilisateur validé";
				echo("<meta http-equiv='refresh' content='1'>");	

			}
			else {
				echo"Demandez a votre administrateur de valider vote compte";
			}
		} 
		else {
			echo 'L\'authentification a échoué pour ' . htmlspecialchars($login) . '.';
			
			if (!isset($_SESSION['count'])) {
				$_SESSION['count'] = 0;
			} 
			else {
				$_SESSION['count']++;
			}
		
		}	
		}	
		?> 
		<h1>Connexion</h1>
		<form name="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<p><label for="login">utilisateur</label> <input type="text" title="Saisissez votre nom" name="login" /></p> 
		<p><label for="password">Mot de passe</label> <input type="password" title="Saisissez le mot de passe" name="password" /></p> 
		<p><input type="submit" name="submit" value="Connexion" />
		<input type="submit" name="nouvel utilisateur" value="Nouveau" formaction="inc/insertPassword.php" /></p>  
		</form>
<?php
		}
	}	
if (isset($_SESSION['authorized'])== true) {
	echo "Bienvenue sur le site d'aministration";
	?>

	<br><a href="administration/lecture_all.php" target="_blank"> Lecture total <br></a>

	<?php	
}	
?>
	<br>
	<a href="inc/logout.php" class="btn btn-secondary">exit<i class="fas fa-angle-right"></i></a>
</body>
</html>
<?php
mysqli_close($connexion);
?>