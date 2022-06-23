<?php

ob_start();
$title = "Ajouter un acteur";
?>
 
<form action="index.php?action=createActeur" method="POST" >
  <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" aria-describedby="nomActeur" placeholder="Eastwood" >
    <div id="nomActeur" class="form-text">Entrez le nom de l'acteur</div>
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Année de sortie</label>
    <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="prenomActeur" placeholder="Clint">
    <div id="prenomActeur" class="form-text">Entrez le prénom de l'acteur</div>
  </div>
  <div class="mb-3">
    <label for="date-de-naissance" class="form-label">Date de naissance</label>
    <input name="date_de_naissance" type="date" class="form-control" aria-describedby="date-de-naissance" id="date-de-naissance" placeholder="1930-05-31">
    <div id="date-de-naissance" class="form-text">Entrez la date de naisssance de l'acteur</div>
    </div>
    <select name="sexe" class="form-select" aria-describedby="sexeActeur">
        <option value="Femme">Femme</option>
        <option value="Homme" selected>Homme</option>
    </select>
    <div id="sexeActeur" class="form-text">Entrez le sexe de l'acteur</div>
 
  <button type="submit" name="submitNewActeur" class="btn btn-primary">Ajouter un acteur</button>
</form>

<!-- bloc de gestion des alerts avec $alert = {success, danger, warning} et $messageAlert pour afficher un message -->
<?php 
if(isset($alert)&&(isset($messageAlert))){
  switch($alert){
    case "success" : $classAlert = "alert-success visible"; break;
    case "danger" : $classAlert = "alert-danger visible"; break;
    case "warning" : $classAlert = "alert-warning visible"; break;
    default : $classAlert = "invisible"; break;
  }
  ?>
  <div class="alert <?= $classAlert ?>" role="alert">
  <?= $messageAlert ?>
  </div>
<?php } ?>
<!-- fin du bloc de gestion des alerts -->



<?php


$contenu = ob_get_clean();
require "./app/views/template.php";
?>