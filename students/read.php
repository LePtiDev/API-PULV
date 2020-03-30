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

        //Récupération des etudiants
        $students = $student->getStudents();

        // Vérification si il y a plus que 1 étudiant
        if($students->rowCount() > 0){

            // tableau asso
            $tabStudents = [];
            $tabStudents['Students'] = [];

            // On remplie le tableau
            while($row = $students->fetch(PDO::FETCH_ASSOC)){

                // on récuprère la ligne
                extract($row);

                $tab = [
                    'id' => $id,
                    'id_student' => $id_student,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'id_class' => $id_class,
                    'INE' => $INE,
                    'adress' => $adress,
                    'phone' => $phone,
                    'birthday' => $birthday,
                    'email_student' => $email_student,
                    'password_student' => $password_student,
                ];

                $tabStudents['Students'][] = $tab;
            }

            // reponse http ok
            http_response_code(200);

            // Transformation json
            echo json_encode($tabStudents);
        }
    }
    else{
        http_response_code(405);
        echo json_encode(["message" => "Cette requête n'est pas autorisé"]);
    }

?>