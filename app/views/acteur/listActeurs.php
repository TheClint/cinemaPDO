<?php

ob_start();
// initialisation du titre
$title = "Les acteurs et actrices";
$compteur=1;

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
        <h1>Liste des Acteurs et Actrices</h1>
        <p>Nous avons <?= $acteurs->rowCount(); ?> acteurs et actrices</p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Date de naissance</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach($acteurs->fetchAll() as $acteur){?>
            <tr>
                <th scope="row"><?=$compteur++?></th>
                <td><a href="index.php?action=detailActeur&id=<?= $acteur['id_acteur']?>"><?= $acteur['nom'] ?></a></td>
                <td><?= $acteur['sexe']?></td>
                <td><?= $acteur['date_de_naissance']?></td>
                <td <?=supprimerVisible($supprimer)?>><a href="index.php?action=supprimerActeur&id=<?= $acteur['id_acteur']?>"><i class="fa-solid fa-circle-xmark"></i></a></td>
                <td <?=modifierVisible($modifier)?>><a href="index.php?action=modifierActeur&id=<?= $acteur['id_acteur']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
            </tr>


        <?php } ?>
            </tbody>
        </table>
    </article>
    <aside class="col-2 text-center">
        <nav class="d-flex flex-column">
            <a class = "crud-boutton" id="ajouter-acteur" href="index.php?action=addActeur">Ajouter acteur</a>
            <a class = "crud-boutton" id="supprimer-acteur" href="index.php?action=menuSupprimerActeur">Supprimer acteur</a>
            <a class = "crud-boutton" id="modifier-acteur" href="index.php?action=menuModifierActeur">Modifier acteur</a>
        </nav>
    </aside>
</div>

<?php

$contenu = ob_get_clean();
require "app/views/template.php";

?>