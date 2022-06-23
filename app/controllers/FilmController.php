<?php

    require_once "app/DAO.php";

    class FilmController{

        // recherche de la liste de tous les films
        public function findAll(){

            $dao = new DAO;

             $sql = "SELECT f.id_film as id_film, f.titre as titre, DATE_FORMAT(f.annee_de_sortie, '%Y') AS annee, CONCAT(cast(f.duree/60 AS SIGNED INTEGER), ':', f.duree%60) AS duree, CONCAT(r.prenom, ' ', r.nom) AS realisateur, r.id_realisateur as id_realisateur
                     FROM film f
                      INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur";
                
            $films = $dao->executerRequete($sql);

            return $films;
        }

        // recherche d'un film par son ID
        public function findOneById(int $id){

            $dao = new DAO;

            $sql = "SELECT f.id_film as id_film, f.titre as titre, f.synopsis as synopsis, DATE_FORMAT(f.annee_de_sortie, '%Y') AS annee, f.duree AS duree, CONCAT(r.prenom, ' ', r.nom) AS realisateur, f.affiche as affiche, f.note as note, r.id_realisateur as id_realisateur
            FROM film f
             INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
             WHERE f.id_film = :id";
             $stmtFilm = $dao->executerRequete($sql, ["id" => $id]);
             
            return $stmtFilm;

        }

        // recherche des acteurs d'un film
        public function findActeursById_Film($id_film){

            $dao = new DAO;

            $sqlCasting = "SELECT CONCAT(a.prenom, ' ', a.nom) as acteur , r.nom_personnage as nom_personnage, a.id_acteur as id_acteur
            FROM acteur a
            INNER JOIN jouer j ON j.id_acteur=a.id_acteur
            INNER JOIN film f ON f.id_film=j.id_film
            INNER JOIN role r ON r.id_role=j.id_role
            WHERE f.id_film = :id_film";
            $stmtActeursFilm = $dao->executerRequete($sqlCasting, ["id_film"=> $id_film]);

            return $stmtActeursFilm;

        }

        // recherche des genres d'un film
        public function findGenresById_Film($id_film){

            $dao = new DAO;

            $sqlGenre = "SELECT g.id_genre as id_genre, g.libelle as libelle, f.id_film as id_film
                        from genre g
                        inner join genrer ge on ge.id_genre = g.id_genre
                        inner join film f on f.id_film=ge.id_film
                        where f.id_film = :id_film";
            $stmtGenresFilm = $dao->executerRequete($sqlGenre, ["id_film"=> $id_film]);

            return $stmtGenresFilm;

        }

        //recherche maximum de l'id_film pour pouvoir ajouter un nouveau film
        public function maxIdFilm(){
            
            $dao = new DAO;

            $sql = "SELECT max(f.id_film)
                    from film f";

            return $dao->executerRequete($sql)->fetch()[0];
        }

        //recherche de la liste des réalisateurs
        public function findAllRealisateur(){

            $dao = new DAO;

            $sql = "SELECT r.id_realisateur as id_realisateur, concat(r.prenom, ' ',r.nom) as realisateur
                from realisateur r";

            return $dao->executerRequete(($sql));
        }

        // renvoie vrai si un titre n'a pas été trouvé dans la base de donnée
        public function isThisFilmNull($titre){

            $dao = new DAO;

            $sql = "SELECT f.id_film as id_film, f.titre as titre
                    FROM film f
                    WHERE UPPER(f.titre) = UPPER(:titre)"; // pour être insensible à la casse
            
            return (boolean)(($dao->executerRequete($sql, ["titre" => $titre])->fetch())==null); //vérifie si le résultat est null
        }

        public function createFilm(){

            $dao = new DAO;

            if(isset($_POST['submitNewFilm'])){

                if((isset($_POST['titre']))&&(isset($_POST['annee']))&&(isset($_POST['duree']))&&(isset($_POST['synopsis']))&&isset($_POST['note'])&&(isset($_POST['id_realisateur']))){
                    
                    if(($this->isThisFilmNull($_POST['titre']))){
                    
                        $sql = "INSERT INTO film (id_film, titre, annee_de_sortie, duree, synopsis, note, affiche, id_realisateur)
                        VALUES (:id_film, :titre, :annee_de_sortie, :duree, :synopsis, :note, :affiche, :id_realisateur)";

                        $id_film = $this->maxIdFilm()+1;
                        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $annee_de_sortie = filter_input(INPUT_POST, 'annee', FILTER_SANITIZE_NUMBER_INT);
                        $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
                        $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $affiche = '';
                        $id_realisateur = filter_input(INPUT_POST, 'id_realisateur', FILTER_SANITIZE_NUMBER_INT);

                        $parametres = array(
                            "id_film"=>$id_film,
                            "titre"=>$titre,
                            "annee_de_sortie"=>$annee_de_sortie."-01-01",
                            "duree"=>$duree,
                            "synopsis"=>$synopsis,
                            "note"=>$note,
                            "affiche"=>$affiche,
                            "id_realisateur"=>$id_realisateur
                        );

                        $result = $dao->executerRequete($sql, $parametres);

                        if($result){
                            $this->afficherListeFilms("success", "Le film a bien été enregistré");
                        }
                    }
                    else{
                        $this->addFilm("danger", "ce film est déjà enregistré dans la base");
                    }
                }
                else{
                    echo "<p>bug sanitize</p>";
                }
            }
            else{
                echo "<p>bug submit</p>";          
            }
        }

        // fonction pour supprimer un film via son id, return vrai si opération réussie
        public function deleteFilm($id_film){

            $dao = new DAO;

            $sql = "DELETE from film where id_film = :id_film";

            return $dao->executerRequete($sql, ["id_film" => $id_film]);
        }

        public function updateFilm(){

            $dao = new DAO;

            if(isset($_POST['submitUpdateFilm'])){

                if((isset($_POST['id_film']))&&(isset($_POST['titre']))&&(isset($_POST['annee']))&&(isset($_POST['duree']))&&(isset($_POST['synopsis']))&&isset($_POST['note'])&&(isset($_POST['id_realisateur']))){
                    
                    $sql = "UPDATE film SET
                            titre = :titre,
                            annee_de_sortie = :annee_de_sortie,
                            duree = :duree,
                            synopsis = :synopsis,
                            note = :note,
                            affiche = :affiche,
                            id_realisateur = :id_realisateur
                            WHERE id_film = :id_film";

                    $id_film = filter_input(INPUT_POST, 'id_film', FILTER_SANITIZE_NUMBER_INT);
                    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $annee_de_sortie = filter_input(INPUT_POST, 'annee', FILTER_SANITIZE_NUMBER_INT);
                    $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
                    $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $affiche = '';
                    $id_realisateur = filter_input(INPUT_POST, 'id_realisateur', FILTER_SANITIZE_NUMBER_INT);

                    $parametres = array(
                        "id_film"=>$id_film,
                        "titre"=>$titre,
                        "annee_de_sortie"=>$annee_de_sortie."-01-01",
                        "duree"=>$duree,
                        "synopsis"=>$synopsis,
                        "note"=>$note,
                        "affiche"=>$affiche,
                        "id_realisateur"=>$id_realisateur
                    );

                    $result = $dao->executerRequete($sql, $parametres);

                    if($result){
                        $this->afficherListeFilms("success", "Le film a bien été modifié");
                    }
                }
                else{
                    echo "<p>bug sanitize</p>";
                }
            }
            else{
                echo "<p>bug submit</p>"; 
            }
        }

        public function modifierFilm($id){

            $stmtRealisateurs = $this->findAllRealisateur();
            $stmtFilm = $this->findOneById($id);
 
             require "app/views/film/updateFilm.php";
 
         }

        public function supprimerFilm($id){

            $result = $this->deleteFilm($id);

            if($result)
                $this->afficherListeFilms("success", "Le film a bien été supprimé");
            else
                $this->afficherListeFilms("danger", "Le film n'a pas été supprimé");
        }

        // fonctions d'affichages

        // affichage dans la page detail film

        public function afficherListeFilms($alert = null, $messageAlert = null){

            $films = $this->findAll();
            $supprimer = false;
            $modifier = false;

            require "app/views/film/listFilms.php";
        }


        public function detailFilm($id_film){


            $stmtActeursFilm = $this->findActeursById_Film($id_film);
            $stmtFilm = $this->findOneById($id_film);
            $stmtGenresFilm = $this->findGenresById_Film($id_film);

            require "app/views/film/detailFilm.php";
        }

        // affichage dans la page addFilm
        public function addFilm($alert = null, $messageAlert = null){

           $stmtRealisateurs = $this->findAllRealisateur();

            require "app/views/film/addFilm.php";

        }

        public function menuSupprimerFilm($alert = null, $messageAlert = null){

            $films = $this->findAll();
            $supprimer = true;
            $modifier = false;

            require "app/views/film/listFilms.php";
        }

        public function menuModifierFilm($alert = null, $messageAlert = null){

            $films = $this->findAll();
            $modifier = true;
            $supprimer = false;

            require "app/views/film/listFilms.php";
        }

        

        
    }

    ?>