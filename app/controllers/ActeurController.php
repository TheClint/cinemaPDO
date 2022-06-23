<?php

    require_once "app/DAO.php";

    class ActeurController{

        public function findAll(){

            $dao = new DAO;

             $sql = "SELECT CONCAT(a.prenom,' ', a.nom) as nom, a.sexe, date_format(a.date_de_naissance, '%d %M %Y') as date_de_naissance, a.id_acteur as id_acteur
             FROM acteur a";
                
            $acteurs = $dao->executerRequete($sql);

            return $acteurs;
            
        }

        // Pour récupérer un acteur par son ID
        public function findOneById($id){

        $dao = new DAO;

        $sql = "SELECT CONCAT(a.prenom,' ', a.nom) as nom, a.sexe, date_format(a.date_de_naissance, '%d %M %Y') as date_de_naissance
        FROM acteur a WHERE a.id_acteur = :id_acteur";

        $stmtActeur = $dao->executerRequete($sql, ["id_acteur" => $id]);

        return $stmtActeur;
        }

        // Pour récupérer la liste de film dans lesquels un acteur a joué
        public function listFilmsParActeur($id){

            $dao = new DAO;

            $sql = "SELECT f.id_film as id_film, f.titre as titre, DATE_FORMAT(f.annee_de_sortie, '%Y') AS annee, r.nom_personnage as nom_personnage, a.id_acteur as id_acteur,concat(re.prenom, ' ', re.nom) as realisateur, re.id_realisateur as id_realisateur
            FROM acteur a
            INNER JOIN jouer j ON j.id_acteur=a.id_acteur
            INNER JOIN film f ON f.id_film=j.id_film
            INNER JOIN role r ON r.id_role=j.id_role 
            inner join realisateur re on re.id_realisateur=f.id_realisateur
            WHERE a.id_acteur= :id_acteur";

            $stmtListFilm = $dao->executerRequete($sql, ["id_acteur" => $id]);

            return $stmtListFilm;
        }

        // Pour afficher la page de la liste des acteurs
        public function afficherListeActeurs(){

            $supprimer = false;
            $modifier = false;

            $acteurs = $this->findAll();

            require "app/views/acteur/listActeurs.php";

        }

        // Pour afficher la page de création d'un acteur
        public function addActeur(){

            require "app/views/acteur/addActeur.php";
        }

        // Pour envoyer les donnés dans la page de vue en détail d'un acteur
        public function detailActeur($id){

            $stmtActeur = $this->findOneById($id);
            $stmtListFilm = $this->listFilmsParActeur($id);

            require "app/views/acteur/detailActeur.php";

        }

        // Pour afficher la page de modification de l'acteur
        public function modifierActeur($id){

            $stmtActeur = $this->findOneById($id);

            require "app/views/acteur/updateActeur.php";

        }

        //recherche maximum de l'id_acteur pour pouvoir ajouter un nouvel acteur
        public function maxIdActeur(){
            
            $dao = new DAO;

            $sql = "SELECT max(a.id_acteur)
                    from acteur a";

            return $dao->executerRequete($sql)->fetch()[0];
        }

        // renvoie vrai si un titre n'a pas été trouvé dans la base de donnée
        public function isThisActeurNull($nom, $prenom){

            $dao = new DAO;

            $sql = "SELECT a.id_acteur as id_acteur, a.nom as nom, a.prenom as prenom
                    FROM acteur a
                    WHERE UPPER(a.nom) = UPPER(:nom) && UPPER(a.prenom) = UPPER(:prenom)"; // pour être insensible à la casse
            
            return (boolean)(($dao->executerRequete($sql, ["nom" => $nom, "prenom" => $prenom])->fetch())==null); //vérifie si le résultat est null
        }

        // fonction pour créer un acteur
        public function createActeur(){
        
            $dao = new DAO;

            if(isset($_POST['submitNewActeur'])){
                if((isset($_POST['nom']))&&(isset($_POST['prenom']))&&(isset($_POST['date_de_naissance']))&&(isset($_POST['sexe']))){                  
                    if(($this->isThisActeurNull($_POST['nom'],$_POST['prenom']))){
                        $sql = "INSERT INTO acteur (id_acteur, nom, prenom, sexe, date_de_naissance)
                        VALUES (:id_acteur, :nom, :prenom, :sexe, :date_de_naissance)";

                        $id_acteur = $this->maxIdActeur()+1;
                        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $date_de_naissance = filter_input(INPUT_POST, 'date_de_naissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        $parametres = array(
                            "id_acteur"=>$id_acteur,
                            "nom"=>$nom,
                            "prenom"=>$prenom,
                            "date_de_naissance"=>$date_de_naissance,
                            "sexe"=>$sexe
                        );

                        $result = $dao->executerRequete($sql, $parametres);

                        if($result){
                            $this->afficherListeActeurs("success", "L'acteur a bien été enregistré");
                        }
                    }
                    else{
                        $this->addActeur("danger", "ce film est déjà enregistré dans la base");
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

        // fonction pour update un acteur
        public function updateActeur(){
        
            $dao = new DAO;

            if(isset($_POST['submitNewActeur'])){
                if((isset($_POST['nom']))&&(isset($_POST['prenom']))&&(isset($_POST['date_de_naissance']))&&(isset($_POST['sexe']))){                  
                    
                    $sql = "UPDATE acteur SET
                    nom = :nom,
                    prenom = :prenom,
                    sexe = :sexe,
                    date_de_naissance = :date_de_naissance
                    WHERE id_acteur = :id_acteur";

                    $id_acteur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $date_de_naissance = filter_input(INPUT_POST, 'date_de_naissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $parametres = array(
                        "id_acteur"=>$id_acteur,
                        "nom"=>$nom,
                        "prenom"=>$prenom,
                        "date_de_naissance"=>$date_de_naissance,
                        "sexe"=>$sexe
                    );

                    $result = $dao->executerRequete($sql, $parametres);

                    if($result){
                        $this->afficherListeActeurs("success", "L'acteur a bien été enregistré");
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

        // fonction pour supprimer un acteur via son id, return vrai si opération réussie
        public function supprimerActeur($id_acteur){

            $dao = new DAO;

            $sql = "DELETE from acteur where id_acteur = :id_acteur";

            return $dao->executerRequete($sql, ["id_acteur" => $id_acteur]);
        }

        public function menuSupprimerActeur($alert = null, $messageAlert = null){

            $acteurs = $this->findAll();
            $supprimer = true;
            $modifier = false;

            require "app/views/acteur/listActeurs.php";
        }

        public function menuModifierActeur($alert = null, $messageAlert = null){

            $acteurs = $this->findAll();
            $modifier = true;
            $supprimer = false;

            require "app/views/acteur/listActeurs.php";
        }
    }

    ?>