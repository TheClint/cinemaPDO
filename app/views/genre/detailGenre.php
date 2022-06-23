<?php

// lancement du tampon
ob_start();

// récupération des requêtes
$title = "Genre";
$genre = $stmtGenre->fetch();
$listFilms = $stmtListFilms->fetchAll();

?>
<!-- affichage des données -->
<h1><?= $genre['libelle']?></h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Libellé</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($listFilms as $film){ ?>
    <tr>
        <td><a href="index.php?action=detailFilm&id=<?= $film['id_film']?>"><?=$film['titre']?></a></td>
        <td><?=$film['annee']?></td>
        <td><a href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?=$film['realisateur']?></a></td>
    </tr>
<?php } ?>
    </tbody>
</table>

<?php

// fin du tampon et envoie dans la views template
$contenu = ob_get_clean();
require "app/views/template.php";

?>
