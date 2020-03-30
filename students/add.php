<?php

    include_once '../config/database.php';
    include_once '../models/students.php';

    // Accessible de partout (si non mettre une ip ou site)
    header("Access-Control-Allow-Origine: *");

    // Format
    header('Content-Type: application/json; charset=UTF-8');

    // Type de méthode autoriser
    header('Access-Control-Allow-Methods: POST');

    // Durée de vie de la requête
    header("Access-Controle-Max-Age: 3600");

    // En tete autoriser
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Récupération de la connection a la bdd
        $database = new Database();
        $db = $database->getConnection();

        // Création de l'objet étudiant
        $student = new Students($db);

        // Récupération des données
        $donnees = json_decode(file_get_contents("php://input"));

        // Vérification si les champs on été remplie
            $student->email_student = $donnees->email_student;
            if(!empty($donnees->firstname) && !empty($donnees->lastname) && !empty($donnes->adress) && !empty($donnees->phone) && !empty($donnees->birthday) && !empty($donnees->email_student) && !empty($donnees->password_student)){

                // on peuple l'objet student
                $student->id_student = $donnees->id_student;
                $student->firstname = $donnees->firstname;
                $student->lastname = $donnees->lastname;
                $student->id_class = $donnees->id_class;
                $student->INE = $donnees->INE;
                $student->adress = $donnees->adress;
                $student->phone = $donnees->phone;
                $student->birthday = $donnees->birthday;
                $student->email_student = $donnees->email_student;
                $student->password_student = $donnees->password_student;

                if($student->addStudent()){
                    http_response_code(201);
                    echo json_encode(["message" => "L'ajout de l'étudiant a été réussis"]);
                }
                else{
                    http_response_code(503);
                    echo json_encode(["message" => "L'ajout de l'étudiant n'a été réussis. Veuillez recommencer"]);
                }
        }
    }
    else{
        http_response_code(405);
        echo json_encode(["message" => "La méthode n'est pas autorisée"]);
    }