<?php
    
    class Database{
        // Nom de la BDD
        private $host = "localhost";
        private $db_name = "PULV";
        private $username = "root";
        private $password = "root";
        private $connexion;

        // fonction de connexion

        public function getConnection(){

            $this->connexion = NULL; // fermeture de l'ancienne connexion
            
            try{
                $this->connexion = new PDO ("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->connexion->exec("set names utf8"); // Update en UTF8
            }
            catch(PDOException $exception){
                echo "Erreur de connexion : " . $exception->getMessage();
            }

            return $this->connexion;
        }
    }

?>