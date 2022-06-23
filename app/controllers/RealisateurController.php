<?php

    require_once "app/DAO.php";

    class RealisateurController{

        // envoie la liste des réalisateurs à listRealisateur
        public function findAll(){

            $dao = new DAO;

             $sql = "SELECT CONCAT(r.prenom,' ', r.nom) as nom, r.sexe, date_format(r.date_de_naissance, '%d %M %Y') as date_de_naissance, r.id_realisateur as id_realisateur
             FROM realisateur r";
                
            $realisateurs = $dao->executerRequete($sql);

            require "app/views/realisateur/listRealisateurs.php";
        }

        // trouve un realisateur par son ID et renvoie la requête
        public function findOneById($id){

            $dao = new DAO;

            $sql = "SELECT CONCAT(r.prenom,' ', r.nom) as nom, r.sexe, date_format(r.date_de_naissance, '%d %M %Y') as date_de_naissance
                    FROM realisateur r
                    WHERE r.id_realisateur = :id";

            $stmtRealisateur = $dao->executerRequete($sql, ["id" => $id]);

            return $stmtRealisateur;
        }

        // trouve l'ensemble des films d'un réalisateur et renvoie sa requête
        public function listFilmsParRealisateur($id){

            $dao = new DAO;

            $sql = "SELECT f.id_film as id_film, f.titre as titre, DATE_FORMAT(f.annee_de_sortie, '%Y') AS annee, CONCAT(cast(f.duree/60 AS SIGNED INTEGER), ':', f.duree%60) AS duree, re.id_realisateur as id_realisateur
            FROM film f 
            inner join realisateur re on re.id_realisateur=f.id_realisateur
            WHERE re.id_realisateur= :id_realisateur";

            $stmtListFilms = $dao->executerRequete($sql, ["id_realisateur" => $id]);

            return $stmtListFilms;
        }

        // envoie les données à detailRealisateur
        public function detailRealisateur($id_realisateur){

            $stmtRealisateur = $this->findOneById($id_realisateur);
            $stmtListFilms = $this->listFilmsParRealisateur($id_realisateur);

            require "app/views/realisateur/detailRealisateur.php";
        }
    }

    ?>