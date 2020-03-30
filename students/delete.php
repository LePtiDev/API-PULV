<?php

    include_once '../config/database.php';
    include_once '../models/students.php';

    // Accessible de partout (si non mettre une ip ou site)
    header("Access-Control-Allow-Origine: *");

    // Format
    header('Content-Type: application/json; charset=UTF-8');

    // Type de méthode autoriser
    header('Access-Control-Allow-Methods: DELETE');

    // Durée de vie de la requête
    header("Access-Controle-Max-Age: 3600");

    // En tete autoriser
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        
        // Récupération de la connection a la bdd
        $database = new Database();
        $db = $database->getConnection();

        // Création de l'objet étudiant
        $student = new Students($db);

        // Récupération des données
        $donnees = json_decode(file_get_contents("php://input"));

        // Vérification que l'on a bien au moins un id
        if(!empty($donnees->id)){
            
            // On peuple l'objet avec l'id
            $student = $donnees->id;

            if($student->deleteStudent()){
                http_response_code(200);
                echo json_encode(["message" => "L'étudiant a bien été suprimer"]);
            }
            else{
                http_response_code(503);
                echo json_encode(["message" => "L'étudiant n'a pas pu être suprimé"]);
            }
        }
    }
    else{
        http_response_code(405);
        echo json_encode(['message' => "La méthode n'est pas autorisé"]);
    }