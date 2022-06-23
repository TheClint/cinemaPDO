<?php

    require_once "app/DAO.php";

    class GenreController{

        // recherche de la liste de tous les genres
        public function findAll(){

            $dao = new DAO;

             $sql = "SELECT genre.libelle as libelle, genre.id_genre as id_genre from genre";
                
            $genres = $dao->executerRequete($sql);

            require "app/views/genre/listGenres.php";
        }

        // recherche et retourne le resultat de la requête d'un genre par ID
        public function findOneById($id_genre){

            $dao = new DAO;

                $sql = "SELECT genre.libelle as libelle, genre.id_genre as id_genre
                         from genre
                         where id_genre=:id";
                
            $stmtGenre = $dao->executerRequete($sql, ["id" => $id_genre]);

            return $stmtGenre;

        }

        // recherche et retourne le resultat de la requête d'une liste de film par genre
        public function listFilmsParGenre($id_genre){

            $dao = new dao;

            $sql = "SELECT g.libelle as libelle, g.id_genre as id_genre, f.titre as titre, DATE_FORMAT(f.annee_de_sortie, '%Y') AS annee, concat(r.prenom, ' ', r.nom) as realisateur, f.id_film as id_film, r.id_realisateur as id_realisateur
                    from genre g
                    inner join genrer ge on ge.id_genre=g.id_genre
                    inner join film f on f.id_film = ge.id_film
                    inner join realisateur r on r.id_realisateur = f.id_realisateur
                    where g.id_genre = :id";

            $stmtListFilms = $dao->executerRequete($sql, ["id" => $id_genre]);

            return $stmtListFilms;

        }

        // fonction appellée pour afficher le détail d'un genre
        public function detailGenre($id){

            $stmtGenre = $this->findOneById($id);
            $stmtListFilms = $this->listFilmsParGenre($id);

            require "app/views/genre/detailGenre.php";
        }
    }

    ?>