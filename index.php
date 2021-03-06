<?php

    // Récéption du json
    $json = file_get_contents("http://localhost:8888/API-PULV/students/read.php");
    $students = json_decode($json);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion de l'API-PULV</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h1>Portail de gestion de l'API-PULV</h1>

    <div class="add">
        <div class="form-student">
            <h2>Ajout d'un étudiant</h2>
            <form method="POST" >
                <div class="form-group">
                    <label for="formGroupExampleInput">Prénom</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Quentin" name="firstname">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nom</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Guerrier" name="lastname">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Date de naissance</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="21/10/1998 (hésitez pas pour les cadeaux)" name="birthday">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Classe</label>
                    <select class="form-control" id="Select" name="class">
                        <option value="DW1">DW1</option>
                        <option value="DW2">DW2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Adresse postal</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="2 avenue des champs élysée 75001" name="adress">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Téléphone</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="0670****** (je vais pas te donner mon num)" name="phone">
                </div>
                <input type="submit" class="btn btn-primary" name="submited" value="Ajouté">
            </form>
            <?php

                include_once './config/database.php';
                include_once './models/students.php';

                // Récupération de la connection a la bdd
                $database = new Database();
                $db = $database->getConnection();
        
                // Création de l'objet étudiant
                $student = new Students($db);

                //préparation de la requete
                $requete = "INSERT INTO Students SET id_student=:id_student, firstname=:firstname, lastname=:lastname, id_class=:id_class, INE=:INE, adress=:adress, phone=:phone, birthday=:birthday, email_student=:email_student, password_student=:password_student";
                $response = $db->prepare($requete);

                // Vérification de la class

                // Vérification si les champs sont bien remplie

                

                if(!empty($_POST['submited'])){

                    $INE = uniqid();
                    $id_student = uniqid();

                    // Ajouts des valeurs au clés
                    $response->bindParam(":id_student", $id_student);
                    $response->bindParam(":firstname", $_POST["firstname"]);
                    $response->bindParam(":lastname", $_POST["lastname"]);
                    $response->bindParam(":id_class", $_POST["class"]);
                    $response->bindParam(":INE", $INE);
                    $response->bindParam(":adress", $_POST["adress"]);
                    $response->bindParam(":phone", $_POST["phone"]);
                    $response->bindParam(":birthday", $_POST["birthday"]);
                    $response->bindParam(":email_student", $_POST["email"]);
                    $response->bindParam(":firstname", $_POST["password"]);

                    var_dump($response);

                    // if($response->execute()){
                    //     echo "L'étudiant a bien été ajouté";
                    // }
                    // else{
                    //     echo "Un probléme est survenu";
                    // }
                }
                else{
                    echo "vous n'avez pas envoyer le formulaire";
                }
            ?>
        </div>
        <div class="form-classroom">

        </div>
    </div>

    <div class="students">
        <h2>Tous les étudiants</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">INE</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mot de passe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($students->Students as $student) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $student->id; ?></th>
                            <td><?php echo $student->firstname; ?></td>
                            <td><?php echo $student->lastname; ?></td>
                            <td><?php echo $student->INE; ?></td>
                            <td><?php echo $student->email_student; ?></td>
                            <td><?php echo $student->password_student; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>