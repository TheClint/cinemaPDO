<?php

ob_start();
$acteur = $stmtActeur->fetch();
$listFilm = $stmtListFilm->fetchAll();

?>

<h1><?= $acteur['nom'] ?> </h1>

<span><?= $acteur['sexe'] ?></span>

<span>Né<?php if($acteur['sexe']=='Femme')echo "e"; ?> le <?= $acteur['date_de_naissance'] ?></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Année</th>
            <th scope="col">Réalisateur</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($listFilm as $film){?>
    <tr>
        <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film['titre']?></a></td>
        <td><?= $film['annee']?></td>
        <td><a href="index.php?action=detailRealisateur&id=<?= $film['id_realisateur']?>"><?=$film['realisateur']?></a></td>
    </tr>
<?php } ?>
    </tbody>
</table>

<?php

    $contenu = ob_get_clean();
    require "app/views/template.php";
?>