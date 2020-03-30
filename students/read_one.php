<?php

    include_once '../config/database.php';
    include_once '../models/students.php';

    // Accessible de partout (si non mettre une ip ou site)
    header("Access-Control-Allow-Origine: *");

    // Format
    header('Content-Type: application/json; charset=UTF-8');

    // Type de méthode autoriser
    header('Access-Control-Allow-Methods: GET');

    // Durée de vie de la requête
    header("Access-Controle-Max-Age: 3600");

    // En tete autoriser
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // Verification de la méthods utilisé

    if($_SERVER["REQUEST_METHOD"] == 'GET'){

        // Base de donnée
        $database = new Database();
        $db = $database->getConnection();

        $student = new Students($db);

        // Récupération de la requête
        $donnee = $_GET['id'];

        // Vérification d'un id dans l'url
        if(!empty($donnee)){

            $student->getStudent($donnee);

            // Verification de l'existance de l'étudiant
            $tab = [
                'id' => $student->id,
                'id_student' => $student->id_student,
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'id_class' => $student->id_class,
                'INE' => $student->INE,
                'adress' => $student->adress,
                'phone' => $student->phone,
                'birthday' => $student->birthday,
                'email_student' => $student->email_student,
                'password_student' => $student->password_student,
            ];

            // réponse ok en http
            http_response_code(200);

            // envoi json
            echo json_encode($tab);
        }
        else{
            http_response_code(404);
            echo json_encode(["message" => "Cet étudiant n'existe pas"]);
        }
    }
    else{
        http_response_code(405);
        echo json_encode(["message" => "Cette requête n'est pas autorisé"]);
    }

?>