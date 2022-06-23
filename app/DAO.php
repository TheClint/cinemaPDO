<?php

Class DAO{

    private $bdd;

    public function __construct(){
        $this->bdd = new PDO("mysql:host=localhost;dbname=cinema;charset=utf8", "root", "");
    }
 
    // Get the value of bdd
    public function getBDD(){
        return $this->bdd;
    }

    public function executerRequete($sql, $params = NULL){
        if ($params == NULL){
            $result = $this->bdd->query($sql);
        }else{
            $result = $this->bdd->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }
}