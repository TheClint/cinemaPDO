<?php

ob_start();
// initialisation du titre
$title = "Les films";

function supprimerVisible($supprimer){
    if($supprimer)
        return  "class='visible'";
    else
        return  "class='invisible'";
}

function modifierVisible($modifier){
    if($modifier)
        return  "class='visible'";
    else
        return  "class='invisible'";
}

?>
<h1>Liste de film</h1>

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

<div class="contain-fluid p-5 row w-100">
    <article class="col-10">
        <p>Nous avons <?= $films->rowCount(); ?> films</p>



        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Année</th>
                    <th scope="col">Durée</th>
                    <th scope="col">Réalisateur</th>
                    <th scope="col" <?=supprimerVisible($supprimer)?>>Supprimer film</th>
                    <th scope="col" <?=modifierVisible($modifier)?>>Modifier film</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach($films->fetchAll() as $film){?>
            <tr>
                <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film['titre']?></a></td>
                <td><?= $film['annee']?></td>
                <td><?= $film['duree']?></td>
                <td><a href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?=$film['realisateur']?></a></td>
                <td <?=supprimerVisible($supprimer)?>><a href="index.php?action=supprimerFilm&id=<?= $film['id_film']?>"><i class="fa-solid fa-circle-xmark"></i></a></td>
                <td <?=modifierVisible($modifier)?>><a href="index.php?action=modifierFilm&id=<?= $film['id_film']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
    </article>
    <aside class="col-2 text-center">
        <nav class="d-flex flex-column">
            <a class = "crud-boutton" id="ajouter-film" href="index.php?action=addFilm">Ajouter film</a>
            <a class = "crud-boutton" id="supprimer-film" href="index.php?action=menuSupprimerFilm">Supprimer film</a>
            <a class = "crud-boutton" id="modifier-film" href="index.php?action=menuModifierFilm">Modifier film</a>
        </nav>
    </aside>
</div>



<?php

//var_dump($films->fetchAll());
$contenu = ob_get_clean();
require "app/views/template.php";

?>