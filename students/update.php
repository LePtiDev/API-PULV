<?php

    include_once '../config/database.php';
    include_once '../models/students.php';

    // Accessible de partout (si non mettre une ip ou site)
    header("Access-Control-Allow-Origine: *");

    // Format
    header('Content-Type: application/json; charset=UTF-8');

    // Type de méthode autoriser
    header('Access-Control-Allow-Methods: PUT');

    // Durée de vie de la requête
    header("Access-Controle-Max-Age: 3600");

    // En tete autoriser
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if($_SERVER["REQUEST_METHOD"] == "PUT"){

        // Récupération de la connection a la bdd
        $database = new Database();
        $db = $database->getConnection();

        // Création de l'objet étudiant
        $student = new Students($db);

        // Récupération des données
        $donnees = json_decode(file_get_contents("php://input"));

        if(!empty($donnees->id) && !empty($donnees->firstname) && !empty($donnees->lastname) && !empty($donnes->adress) && !empty($donnees->phone) && !empty($donnees->birthday) && !empty($donnees->password_student)){

            // on peuple l'objet student
            $student->id = $donnees->id;
            $student->firstname = $donnees->firstname;
            $student->lastname = $donnees->lastname;
            $student->adress = $donnees->adress;
            $student->phone = $donnees->phone;
            $student->birthday = $donnees->birthday;
            $student->password_student = $donnees->password_student;

            if($student->updateStudent()){

                http_response_code(200);
                echo json_encode(["message" => "L'étudiant a été mis a jour"]);
            }
            else{
                http_response_code(503);
                echo json_encode(["message" => "L'étudiant n'a pas ou etre mis a jours"]);
            }
        }
    }