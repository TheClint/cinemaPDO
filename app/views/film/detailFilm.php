<?php



ob_start();
$title = "Film";
$film = $stmtFilm->fetch();
$listActeursParFilm = $stmtActeursFilm->fetchAll();
$listGenresParFilm = $stmtGenresFilm->fetchAll();
$count=0;

?>

<div class="row">
    <aside class="col-4">
        <figure class="w-100 p-3">
            <img src=.\public\img\film\<?=$film['affiche']?> alt="" srcset="">
        </figure>
    </aside>
    <article class="col-8">
        <h1><?= $film['titre'] ?></h1>

        <div class="row">
            <table class="table col">
                <tbody>
                    <tr class="table-primary">
                        <td>Année</td>
                        <td><?= $film['annee']?></td>
                    </tr>
                    <tr class="table-secondary">
                        <td>Durée</td>
                        <td><?php echo (int)($film['duree']/60).":".($film['duree']%60) ?></td></tr>
                    <tr class="table-primary">
                        <td>Réalisateur</td>
                        <td><?= $film['realisateur']?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table col text-center">
                <thead>
                    <tr>
                        <th scope="col">Liste des genres</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listGenresParFilm as $genre){ ?>
                    <tr>
                        <td><a href="index.php?action=detailGenre&id=<?= $genre['id_genre']?>"> <?= $genre['libelle'] ?></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h2>Synopsis</h2>
        <p><?= $film['synopsis'] ?></p>

            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Acteur ou Actrice</th>
                    <th scope="col">Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listActeursParFilm as $acteur){ 
                    $couleur = ($count%2==0) ? "class='table-primary'" : "class='table-secondary'";
                    $count++;
                    ?>
                <tr <?=$couleur?>>
                    <td><a href="index.php?action=detailActeur&id=<?= $acteur['id_acteur']?>"> <?= $acteur['acteur'] ?></a></td>
                    <td><?= $acteur['nom_personnage'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </article>
</div>



<?php 

$contenu = ob_get_clean();
require "app/views/template.php";

?>