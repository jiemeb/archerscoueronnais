<?php
session_start();


include("inc/questionsCaptcha.php");

# Activation des sessions (pour que PHP charge la session de l'utilisateur, via le cookie PHPSESSID)
# à placer impérativement avant tout affichage, car cette fonction a besoin d'envoyer des headers HTTP


# Sélection d'une question à poser au hasard
$id_question_posee = array_rand($liste_questions);

# Mémorisation de la question posée à l'utilisateur dans la session
$_SESSION['captcha']['id_question_posee'] = $id_question_posee;
?>



  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


  <script type="text/javascript">
    function getAge() {
      var dateNaissance = new Date(document.getElementById("formulaire").elements["dateNaissance"].value);
      //     var diff = Date.now() - dateNaissance.getTime();
      var date_fin = new Date('2025-12-31');

      var diff = date_fin - dateNaissance.getTime();

      var age = new Date(diff);
      var ageFede = Math.abs(age.getUTCFullYear() - 1970);
      //alert("age ="+ ageFede);
      document.getElementById("formulaire").elements["age"].value = ageFede;
      if (ageFede < 18) {

        // affiche la zone spécifique aux enfants
        $(".zoneVisibleEnfant").show();

        document.getElementById("nomRep1").required = true;
        document.getElementById("prenomRep1").required = true;
        document.getElementById("nomRep2").required = false;
        document.getElementById("prenomRep2").required = false;
        document.getElementById("telephone2").required = true;
        document.getElementById("email2").required = false;


        switch (ageFede) {
          case 8:
          case 9:
          case 10:
            document.getElementById("categories").value = 0;
            break;
          case 11:
          case 12:
            document.getElementById("categories").value = 1;
            break;
          case 13:
          case 14:
            document.getElementById("categories").value = 2;
            break;
          case 15:
          case 16:
          case 17:
            document.getElementById("categories").value = 3;
            break;
          case 18:
          case 19:
          case 20:
            document.getElementById("categories").value = 4;
            break;
        }
      } else {

        // masque la zone spécifique aux enfants
        $(".zoneVisibleEnfant").hide();

        document.getElementById("prenomRep1").required = false;
        document.getElementById("nomRep1").required = false;
        document.getElementById("prenomRep2").required = false;
        document.getElementById("nomRep2").required = false;
        document.getElementById("telephone2").required = false;
        document.getElementById("email2").required = false;

        if (ageFede > 20)
          document.getElementById("categories").value = 5;
        else
          document.getElementById("categories").value = 4;
      }
    }

    //   alert( " age "+getAge()); //Date(année, mois, jour)
    //  alert(getAge(new Date(1995, 12, 6))); //Date(année, mois, jour)
  </script>
  <link type="text/css" rel="stylesheet" href="css/style.css">
<?php
include("inc/entete.php");
?>

  <div class="container">
    <div class="row">
      <div class="col">
        <form action="traitementReponse.php" method="post" id="formulaire">
          <input type="hidden" name="mineur">
          <input type="hidden" name="age">
<div><br></div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" value="Madame" required>
            <label class="form-check-label">
              Madame
            </label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="civilite" value="Monsieur" required>
            <label class="form-check-label">
              Monsieur
            </label>
          </div>


          <div class="row">
            <div class="col-md">
              <div class="mb-2">
                <label class="form-label">Prénom*</label>
                <input type="text" name="prenom" class="text-capitalize form-control" required="required">
              </div>
            </div>
            <div class="col-md">
              <div class="mb-2">
                <label class="form-label">Nom*</label>
                <input type="text" name="nom"  class="text-uppercase form-control" required="required">
              </div>
            </div>
            <div class="col-md">
              <div class="mb-2">
                <label class="form-label">Date de naissance*</label>
                <input type="date" name="dateNaissance" class="form-control" required="required" onblur="javascript:getAge()">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Nationalité*</label>
                <input type="text" name="nationalite" class="text-uppercase form-control" required="required">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <div class="mb-2">
                <label class="form-label">Email de contact*</label>
                <input type="email" name="email1" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Téléphone*</label>
                <input type="text" name="telephone1" class="form-control" pattern="[0-9+ ]+" minlenght="10" maxlenght="20" required="required">
              </div>
            </div>
          </div>





          <div class="row">
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Adresse*</label>
                <input type="text" name="adresse" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Code postal*</label>
                <input type="text" name="cp" class="form-control" pattern="[0-9]{5}" maxlenght="5" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Commune*</label>
                <input type="text" name="commune" class="form-control" required="required">
              </div>
            </div>
          </div>





          <div class="row mt-5 zoneVisibleEnfant">
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Prénom representant legal1*</label>
                <input type="text" name="prenomRep1" id="prenomRep1" class="text-capitalize form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Nom representant legal1*</label>
                <input type="text" name="nomRep1" id="nomRep1" class="text-uppercase form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Telephone*</label>
                <input type="text" name="telephone2" id="telephone2" class="form-control" pattern="[0-9+\s]+" minlenght="10" maxlenght="20" required="required">
              </div>
            </div>
          </div>


          <div class="row mt-5 zoneVisibleEnfant">
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Prénom representant legal2*</label>
                <input type="text" name="prenomRep2" id="prenomRep2" class="text-capitalize form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Nom representant legal2*</label>
                <input type="text" name="nomRep2" id="nomRep2" class="text-uppercase form-control"  maxlenght="20" required="required">
              </div>
            </div>

            <div class="col-md-12">
              <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email2" id="email2" class="form-control">
              </div>
            </div>
          </div>


          <div class="row mt-5">
            <div class="col">
              <div class="mb-2">
                <label class="form-label">Catégories de l'archer*</label>
                <select class="form-select" name="categories" id="categories">
<?php
                $messageOption = "<option value=0>Poussins - Années de naissance : Apres ";
                $messageOption .=$annee__fede -11 ." - Tarif ".$license[0]." euros</option>";
                echo $messageOption ;

                $messageOption = "<option value=1>Benjamins - Années de naissance : ";
                $messageOption .= $annee__fede-11 ." et "  ;
                $messageOption .= $annee__fede -12 ;
                $messageOption .="  - Tarif ".$license [1]." euros</option>" ;
                echo $messageOption ;

                $messageOption = "<option value=2>Minimes - Années de naissance : ";
                $messageOption .=$annee__fede-13 ." et " ;
                $messageOption .=$annee__fede -14 ."  - Tarif ".$license [2]." euros</option>" ;
                echo $messageOption ;

                $messageOption = "<option value=3>Cadets - Années de naissance : " ;
                $messageOption .=$annee__fede -15 . ",  ";
                $messageOption .=$annee__fede -16 ." et " ;
                $messageOption .=$annee__fede -17 ." - Tarif ".$license [3]." euros</option>" ;

                echo $messageOption ;
   
                $messageOption = "<option value=4>Jeunes - Années de naissance : ";
                $messageOption .=$annee__fede -18 .", ";
                $messageOption .=$annee__fede -19 ." et " ;
                $messageOption .=$annee__fede -20 ." - Tarif ".$license [4]." euros</option>" ;

                echo $messageOption ;

                $messageOption = "<option value=5>Séniors - Années de naissance : avant ";
                $messageOption .=$annee__fede -20 ." - Tarif ".$license [5]." euros</option>" ;
                echo $messageOption ;
   
?>
                </select>
              </div>
            </div>
          </div>


          <div class="row mt-5">
            <div class="col">
              J'accepte d'être pris en photo ou vidéo dans le cadre d’activités sportives de l’ESC Tir à l’Arc de Couëron, ou lors des sorties en compétition organisées par celui-ci. *<br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="droitimageClub" value="oui" checked required>
                <label class="form-check-label">
                  Oui
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="droitimageClub" value="non">
                <label class="form-check-label">
                  Non
                </label>
              </div>
            </div>
          </div>





          <div class="row mt-5">
            <div class="col">
              J'autorise que l’ESC Tir à l’Arc de Couëron, la ville de Couëron et les quotidiens régionaux
              à utiliser ces images pour illustrer d’éventuels articles, bulletins, plaquettes, expositions, affiches ou diaporama le représentant. *<br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="droitimagePress" value="oui" checked required>
                <label class="form-check-label">
                  Oui
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="droitimagePress" value="non">
                <label class="form-check-label">
                  Non
                </label>
              </div>
            </div>
          </div>



          <div class="row mt-5">
            <div class="col-md-12">
              <label><b>Souhaitez-vous un kit pour archer ?</b></label>
              Contenu du kit : 6 flèches + Un carquois + Une palette à cale (DECUT) + Une protection de bras + Une dragonne doigt<br>

              <br>
              <?php
              echo "Je souhaite un kit tir à l'arc d'un montant de ".$kit." €<br>" ;
              ?>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kit" value="oui" required>
                <label class="form-check-label">
                  Oui
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="kit" value="non" checked required>
                <label class="form-check-label">
                  Non
                </label>
              </div>
            </div>
            <div class="col-md-12">
              <br>
              <?php
              echo "Je souhaite 3 flèches supplementaires d'un montant de ".$lot." €<br>" ;
              ?>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="lot" value="oui" required>
                <label class="form-check-label">
                  Oui
                </label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="lot" value="non" checked required>
                <label class="form-check-label">
                  Non
                </label>
              </div>
            </div>
          </div>


          <div class="row mt-2">
            <div class="col-md-12">
              <article style="border: 2px solid ; padding: 10px;">
                <h3>Captcha</h3>
                Question : <?php echo $liste_questions[$id_question_posee]['question']; ?><br>
                Réponse : <input type="text" name="captcha_reponse" value="" required>
              </article>
            </div>
          </div>



          <div class="row mt-5 mb-5">
            <div class="col">
            <input class="btn btn-success" type="submit" value="Validez votre inscription" title="suite Inscription">
            </div>
            <div class="col text-end">
            <a href="index.php" class="btn btn-secondary">Retour <i class="fas fa-undo"></i></a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</body>

</html>
