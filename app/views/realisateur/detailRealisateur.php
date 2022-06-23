<?php

// lancement du tampon
ob_start();

// récupération des requêtes
$title = "Realisateur";
$realisateur = $stmtRealisateur->fetch();
$listFilms = $stmtListFilms->fetchAll();

?>

<!-- affichage des données -->
<h1><?= $realisateur['nom'] ?> </h1>

<span><?= $realisateur['sexe'] ?></span>

<span>Né<?php if($realisateur['sexe']=='Femme')echo "e"; ?> le <?= $realisateur['date_de_naissance'] ?></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Année</th>
            <th scope="col">Durée</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($listFilms as $film){?>
    <tr>
        <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film['titre']?></a></td>
        <td><?= $film['annee']?></td>
        <td><?= $film['duree']?></td>
    </tr>
<?php } ?>
    </tbody>
</table>

<?php

// fin du tampon et envoie dans la views template
$contenu = ob_get_clean();
require "app/views/template.php";

?>