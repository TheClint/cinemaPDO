<?php

ob_start();
$listRealisateurs = $stmtRealisateurs->fetchAll();
$title = "Ajouter un film";
?>
 
<form action="index.php?action=createFilm" method="POST">
  <div class="mb-3">
    <label for="titreFilm" class="form-label">Titre</label>
    <input type="text" class="form-control" id="titreFilm" name="titre" aria-describedby="titreFilm" placeholder="Le Pont de la rivière Kwaï" >
    <div id="titreFilm" class="form-text">Entrez le titre du film</div>
  </div>
  <div class="mb-3">
    <label for="anneeFilm" class="form-label">Année de sortie</label>
    <input type="number" class="form-control" id="anneeFilm" name="annee" aria-describedby="anneeFilm" placeholder="1957">
    <div id="anneeFilm" class="form-text">Entrez l'année de sortie du film</div>
  </div>
  <div class="mb-3">
    <label for="dureeFilm" class="form-label">Durée</label>
    <input type="number" class="form-control" id="dureeFilm" name="duree" aria-describedby="dureeFilm" placeholder="161">
    <div id="dureeFilm" class="form-text">Entrez la durée du film en minute</div>
  </div>
  <div class="mb-3">
    <label for="synopsisFilm" class="form-label">Synopsis</label>
    <input type=textarea id="synopsisFilm" class="form-control" name="synopsis" aria-label="With textarea" aria-describedby="synopsisFilm" placeholder="1943. Un régiment britannique est emprisonné dans un camp japonais, dirigé par le colonel Saito. Devant le refus du colonel anglais Nicholson de forcer ses hommes à construire un pont, Saito lui fait endurer les pires sévices mais n'obtient aucun résultat. Nicholson finit par prendre la tête des opérations mais les Américains débarquent..."></textarea>
    <div id="synopsisFilm" class="form-text">Entrez le synopsis du film</div>
  </div>
  <div class="mb-3">
    <label for="noteFilm" class="form-label">Note</label>
    <input type="text" class="form-control" id="noteFilm" name="note" aria-describedby="noteFilm" placeholder="4.1">
    <div id="noteFilm" class="form-text">Entrez la note du film</div>
  </div>


<select name="id_realisateur" class="form-select" aria-label="Default select example">
  <option selected>Réalisateur</option>
    <?php foreach($listRealisateurs as $realisateur){?>
      <option value="<?=$realisateur['id_realisateur']?>"><?=$realisateur['realisateur']?></option>
    <?php } ?>
</select>
 
  <button type="submit" name="submitNewFilm" class="btn btn-primary">Ajouter</button>
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