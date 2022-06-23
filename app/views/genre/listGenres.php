<?php

ob_start();
// initialisation du titre
$title = "Les genres";
?>

<div class="contain p-5">

    <h1>Liste des genres</h1>
    <p>Nous avons <?= $genres->rowCount(); ?> genres</p>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($genres->fetchAll() as $genre){?>
        <tr>
            <td><a href="index.php?action=detailGenre&id=<?= $genre['id_genre']?>"> <?= $genre['libelle'] ?></a></td>
        </tr>
    <?php } ?>
        </tbody>
    </table>
</div>
<?php

$contenu = ob_get_clean();
require "app/views/template.php";

?>