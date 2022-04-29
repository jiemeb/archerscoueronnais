<?php
# Liste des questions avec leurs différentes réponses possibles

include("inc/questionsCaptcha.php");
# Activation des sessions (pour que PHP charge la session de l'utilisateur, via le cookie PHPSESSID)
# à placer impérativement avant tout affichage, car cette fonction a besoin d'envoyer des headers HTTP
session_start();
 
# Sélection d'une question à poser au hasard
$id_question_posee = array_rand($liste_questions);
 
# Mémorisation de la question posée à l'utilisateur dans la session
$_SESSION['captcha']['id_question_posee'] = $id_question_posee;
 
# Affichage du formulaire HTML
?>
<form action="traitementRéponse.php" method="post">
    <h3>Captcha</h3>
    Question : <?php echo $liste_questions[$id_question_posee]['question']; ?>
    Réponse  : <input type="text" name="captcha_reponse" value="" />
 
    <input type="submit" value="Envoyer le formulaire" />
</form>
