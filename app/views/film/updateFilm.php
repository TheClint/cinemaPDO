<?php

ob_start();
$listRealisateurs = $stmtRealisateurs->fetchAll();
$film = $stmtFilm->fetch();
$title = "Modifier un film";


?>
<form action="index.php?action=updateFilm" method="POST">
    <input name="id_film" class="invisible" value="<?= $id ?>"> 
  <div class="mb-3">
    <label for="titreFilm" class="form-label">Titre</label>
    <input type="text" class="form-control" id="titreFilm" name="titre" aria-describedby="titreFilm" value="<?= $film['titre'] ?>"  >
    <div id="titreFilm" class="form-text">Entrez le titre du film</div>
  </div>
  <div class="mb-3">
    <label for="anneeFilm" class="form-label">Année de sortie</label>
    <input type="number" class="form-control" id="anneeFilm" name="annee" aria-describedby="anneeFilm" value="<?= $film['annee'] ?>">
    <div id="anneeFilm" class="form-text">Entrez l'année de sortie du film</div>
  </div>
  <div class="mb-3">
    <label for="dureeFilm" class="form-label">Durée</label>
    <input type="number" class="form-control" id="dureeFilm" name="duree" aria-describedby="dureeFilm" value="<?=$film['duree']?>">
    <div id="dureeFilm" class="form-text">Entrez la durée du film en minute</div>
  </div>
  <div class="mb-3">
    <label for="synopsisFilm" class="form-label">Synopsis</label>
    <textarea id="synopsisFilm" class="form-control" name="synopsis" aria-label="With textarea" aria-describedby="synopsisFilm"><?= $film['synopsis'] ?></textarea>
    <div id="synopsisFilm" class="form-text">Entrez le synopsis du film</div>
  </div>
  <div class="mb-3">
    <label for="noteFilm" class="form-label">Note</label>
    <input type="text" class="form-control" id="noteFilm" name="note" aria-describedby="noteFilm" value="<?= $film['note'] ?>">
    <div id="noteFilm" class="form-text">Entrez la note du film</div>
  </div>


<select name="id_realisateur" class="form-select" aria-label="Default realisateur du film">
    <?php foreach($listRealisateurs as $realisateur){?>
      <option value="<?=$realisateur['id_realisateur']?>" <?php if($realisateur['id_realisateur']==$film['id_realisateur']){echo "selected";} ?>><?=$realisateur['realisateur']?></option>
    <?php } ?>
</select>
 
  <button type="submit" name="submitUpdateFilm" class="btn btn-primary">Modifier</button>
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