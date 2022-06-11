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

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


  <script type="text/javascript">
    function getAge() {
      var dateNaissance = new Date(document.getElementById("formulaire").elements["dateNaissance"].value);
      //     var diff = Date.now() - dateNaissance.getTime();
      var date_fin = new Date('2023-12-31');

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
</head>

<body scroll=yes>
  <div class="container">
		<div class="row">
			<div class="col-sm-2 d-none d-sm-block"><img src="/images/logo.jpg" class="img-fluid" /></div>
			<div class="col-sm-8">
				<h1>Archers de Coüeron</h1>
				<h2>Inscriptions saison 2022-2023</h2>
			</div>
			<div class="col-sm-2 d-none d-sm-block text-end"><img src="/images/cible.gif" class="img-fluid" /></div>
		</div>
	</div>


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
                <input type="text" name="prenom" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md">
              <div class="mb-2">
                <label class="form-label">Nom*</label>
                <input type="text" name="nom" class="form-control" required="required">
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
                <input type="text" name="nationnalite" class="form-control" required="required">
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
                <input type="text" name="prenomRep1" id="prenomRep1" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Nom representant legal1*</label>
                <input type="text" name="nomRep1" id="nomRep1" class="form-control" required="required">
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
                <label class="form-label">Prénom representant legal2</label>
                <input type="text" name="prenomRep2" id="prenomRep2" class="form-control" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-2">
                <label class="form-label">Nom representant legal2</label>
                <input type="text" name="nomRep2" id="nomRep2" class="form-control"  maxlenght="20" required="required">
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
                  <option value=0>Poussins - Années de naissance : Apres 2012 - Tarif 67 euros</option>
                  <option value=1>Benjamins - Années de naissance : 2012 et 2011 - Tarif 67 euros</option>
                  <option value=2>Minimes - Années de naissance : 2010 et 2009 - Tarif 70 euros</option>
                  <option value=3>Cadets - Années de naissance : 2008, 2007 et 2006 - Tarif 70 euros</option>
                  <option value=4>Jeunes - Années de naissance : 2005, 2004 et 2003 - Tarif 80 euros</option>
                  <option value=5>Séniors - Années de naissance : avant 2003 - Tarif 95 euros</option>
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
              Contenu du kit : 6 flèches + Un carquois + Une palette à cale (DECUT) + Une protection de bras + Une dragonne poignée ou doigt<br>

              <br>
              Je souhaite un kit tir à l'arc d'un montant de 44 €<br>
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
              Je souhaite 3 flèches supplementaires d'un montant de 10 €<br>
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
