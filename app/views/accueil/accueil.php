<?php

// ouverture de la mise en tampon pour le contenu suivant
ob_start();

?>

<h1>Ciné à l'huile <br><small class="text-muted"> pour du film gras </small></h1>


<div class="container-sm w-50 p-3 max-height: 100%;">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="public/img/caroussel-accueil/the-lost-city.jpg" class="d-block w-100" alt="affiche de the lost city">
        </div>
        <div class="carousel-item">
        <img src="public/img/caroussel-accueil/le-reveil-de-la-force.jpg" class="d-block w-100" alt="affiche le réveil de la force">
        </div>
        <div class="carousel-item">
        <img src="public/img/caroussel-accueil/la_grande_illusion.jpg" class="d-block w-100" alt="affiche de la grande évasion">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</div>

<p>Le site des cinéphiles qui n'apprécient pas l'eau. Recherchez vos films et acteurs préférés sur ce site</p>

<?php 

// envoie du contenu dans la variable contenu
$contenu = ob_get_clean();
$title = "Page d'accueil";
require "./app/views/template.php";

