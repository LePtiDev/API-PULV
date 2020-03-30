<?php
    class Students{

        // variable de connection 

        private $connexion;
        private $table = "Students";

        // variable de la class Students
        public $id;
        public $id_student;
        public $firstname;
        public $lastname;
        public $id_class;
        public $INE;
        public $adress;
        public $phone;
        public $birthday;
        public $email_student;
        public $password_student;

        /**
         * Récupération de la connection
         * @param $database
         */
        public function __construct($database)
        {  
            $this->connexion = $database;
        }

        /**
         * Permet d'ajouter un étudiant
         */
        public function addStudent(){

            // Requête et préparation
            $requete = "INSERT INTO " . $this->table . " SET id_student=:id_student, firstname=:firstname, lastname=:lastname, id_class=:id_class, INE=:INE, adress=:adress, phone=:phone, birthday=:birthday, email_student=:email_student, password_student=:password_student";
            $response = $this->connexion->prepare($requete);

            //Protection injection SQL
            $this->id_student=htmlspecialchars(strip_tags($this->id_student));
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->id_class=htmlspecialchars(strip_tags($this->id_class));
            $this->INE=htmlspecialchars(strip_tags($this->INE));
            $this->adress=htmlspecialchars(strip_tags($this->adress));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->birthday=htmlspecialchars(strip_tags($this->birthday));
            $this->email_student=htmlspecialchars(strip_tags($this->email_student));
            $this->password_student=htmlspecialchars(strip_tags($this->password_student));

            // Ajouts des valeurs au clés
            $response->bindParam("id_student", $this->id_student);
            $response->bindParam("firstname", $this->firstname);
            $response->bindParam("lastname", $this->lastname);
            $response->bindParam("id_class", $this->id_class);
            $response->bindParam("INE", $this->INE);
            $response->bindParam("adress", $this->adress);
            $response->bindParam("phone", $this->phone);
            $response->bindParam("birthday", $this->birthday);
            $response->bindParam("email_student", $this->email_student);
            $response->bindParam("firstname", $this->password_student);

            if($response->execute()){
                return true;
            }

            return false;
        }

        /**
         *  Récupérer la liste des étudiants
         */
        public function getStudents(){

            // Requête et préparation
            $requete = "SELECT * FROM " . $this->table;
            $response = $this->connexion->prepare($requete);

            $response->execute();

            return  $response;
        }

        /**
         *  Récupérer un seul étudiant avec son id
         */

        public function getStudent($myid){

            // Requête et préparation
            $requete = "SELECT * FROM " . $this->table ." WHERE id = $myid";
            $response = $this->connexion->prepare($requete);

            $response->execute();

            // Récupération de la ligne et mise en tableau
            $row = $response->fetch(PDO::FETCH_ASSOC);
            
            // On peuple l'objet avec la réponse 
            $this->id = $row["id"];
            $this->id_student = $row["id_student"];
            $this->firstname = "Quentin";
            $this->lastname = $row["lastname"];
            $this->id_class = $row["id_class"];
            $this->INE = $row["INE"];
            $this->adress = $row["adress"];
            $this->phone = $row["phone"];
            $this->birthday = $row["birthday"];
            $this->email_student = $row["email_student"];
            $this->password_student = $row["password_student"];
        }

        /**
         *  Modification d'un étudiant
         */
        public function updateStudent(){

            // Requête et préparation a l'update
            $requete = "UPDATE " . $this->table . " SET id_student=:id_student, firstname=:firstname, lastname=:lastname, id_class=:id_class, INE=:INE, adress=:adress, phone=:phone, birthday=:birthday, email_student=:email_student, password_student=:password_student";
            $response = $this->connexion->prepare($requete);

            //Protection injection SQL
            $this->id_student=htmlspecialchars(strip_tags($this->id_student));
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->id_class=htmlspecialchars(strip_tags($this->id_class));
            $this->INE=htmlspecialchars(strip_tags($this->INE));
            $this->adress=htmlspecialchars(strip_tags($this->adress));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->birthday=htmlspecialchars(strip_tags($this->birthday));
            $this->email_student=htmlspecialchars(strip_tags($this->email_student));
            $this->password_student=htmlspecialchars(strip_tags($this->password_student));

            // Ajouts des valeurs au clés
            $response->bindParam("id_student", $this->id_student);
            $response->bindParam("firstname", $this->firstname);
            $response->bindParam("lastname", $this->lastname);
            $response->bindParam("id_class", $this->id_class);
            $response->bindParam("INE", $this->INE);
            $response->bindParam("adress", $this->adress);
            $response->bindParam("phone", $this->phone);
            $response->bindParam("birthday", $this->birthday);
            $response->bindParam("email_student", $this->email_student);
            $response->bindParam("firstname", $this->password_student);

            if($response->execute()){
                return true;
            }

            return false;
        }

        /**
         *  Suprimer l'étudiant en base de donnée
         */
        public function deleteStudent(){

            // Requête et préparation a la supression
            $requete = "DELETE FROM " . $this->table . " WHERE id = ?";
            $response = $this->connexion->prepare($requete);

            // protéction au injection sql
            $this->id=htmlspecialchars(strip_tags($this->id));

            // association de la clé
            $response->bindParam(1, $this->id);

            if($response->execute()){
                return true;
            }

            return false;

        }
    }

?>