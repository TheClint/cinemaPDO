<?php

    ob_start();
    $title = "Les réalisateurs et réalisatrices";
?>

<div class="contain p-5">
    <h1>Liste des réalisateurs et réalisatrices</h1>
    <p>Nous avons <?= $realisateurs->rowCount(); ?> réalisateurs et réalisatrices</p>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Sexe</th>
                <th scope="col">Date de naissance</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($realisateurs->fetchAll() as $realisateur){?>
        <tr>
            <td><a href="index.php?action=detailRealisateur&id=<?= $realisateur['id_realisateur']?>"><?=$realisateur['nom']?></a></td>
            <td><?= $realisateur['sexe']?></td>
            <td><?= $realisateur['date_de_naissance']?></td>
        </tr>
    <?php } ?>
        </tbody>
    </table>
</div>

<?php

$contenu = ob_get_clean();
require "app/views/template.php";

?>

