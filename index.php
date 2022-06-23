<?php

/* L'index permet d'appeler et d'instancier les controllers et d'orienter aussi l'utilisateur 
suivant les actions qui lui sont envoyées */

require_once "app/controllers/FilmController.php";
require_once "app/controllers/AccueilController.php";
require_once "app/controllers/RealisateurController.php";
require_once "app/controllers/ActeurController.php";
require_once "app/controllers/GenreController.php";

$ctrlAccueil = new AccueilController;
$ctrlActeur = new ActeurController;
$ctrlFilm = new FilmController;
$ctrlGenre = new GenreController;
$ctrlRealisateur = new RealisateurController;


if(isset($_GET['action'])){

    switch($_GET['action']){

        case "addActeur" : $ctrlActeur->addActeur();break;
        case "addFilm" : $ctrlFilm->addFilm();break;
        case "createFilm" : $ctrlFilm->createFilm();break;
        case "createActeur" : $ctrlActeur->createActeur();break;
        case "detailActeur" : $ctrlActeur->detailActeur($_GET["id"]);break;
        case "detailFilm" : $ctrlFilm->detailFilm($_GET["id"]);break;
        case "detailGenre" : $ctrlGenre->detailGenre($_GET["id"]);break;
        case "detailRealisateur" : $ctrlRealisateur->detailRealisateur($_GET["id"]); break;
        case "listActeurs" : $ctrlActeur->afficherListeActeurs();break;
        case "listFilms" : $ctrlFilm->afficherListeFilms();break;
        case "listGenres" : $ctrlGenre->findAll();break;
        case "listRealisateurs" : $ctrlRealisateur->findAll();break;
        case "menuModifierActeur" : $ctrlActeur->menuModifierActeur();break;
        case "menuModifierFilm" : $ctrlFilm->menuModifierFilm();break;
        case "menuSupprimerActeur" : $ctrlActeur->menuSupprimerActeur();break;
        case "menuSupprimerFilm" : $ctrlFilm->menuSupprimerFilm();break;
        case "modifierActeur" : $ctrlActeur->modifierActeur($_GET["id"]);break;
        case "modifierFilm" : $ctrlFilm->modifierFilm($_GET["id"]);break;
        case "supprimerActeur" : $ctrlActeur->supprimerActeur($_GET["id"]);break;
        case "supprimerFilm" : $ctrlFilm->supprimerFilm($_GET["id"]);break;
        case "updateFilm" : $ctrlFilm->updateFilm();break;
        
    }
}else{
    // retour à l'accueil si il n'y a pas d'action
    $ctrlAccueil->pageAccueil();
}