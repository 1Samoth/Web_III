<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>BD Étudiants</title>
</head>
<body style="background-color:#212529;">
<!-- s'assurer que c'est un identifiant unique, associé à un mot de passe crypté-->
<!-- Connection à la BD -->
    <?php
        if($_SESSION["connexion"] == true){
        if(isset($_GET['action'])){
            if($_GET['action'] == "reussi"){
                ?>
                <script>alert("action réussie");</script>
                <?php
            }
        }
        
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "students";

        //Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        //Définir la langue au cas ou
        $conn->query('SET NAMES utf16');

        //Check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully <br>";
        
        //ca fait rien ca fait juste créer un string avec une requete
        $sql = "SELECT * FROM etudiants";
        
        //L'action, la query est ici
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            //open table + head + table body open
            echo    "<table class=\"table table-dark table-striped table-hover\" style=\"margin-right:1%;\">
                        <thead>
                            <tr>
                                <th scope=\"col\">#id</th>
                                <th scope=\"col\">Photo Étudiante</th>
                                <th scope=\"col\">Nom, Prénom</th>
                                <th scope=\"col\">Matricule</th>
                                <th scope=\"col\">Programme</th>
                                <th scope=\"col\">Modifier</th>
                                <th scope=\"col\">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>";
            // output data of each row
            while($row = $result->fetch_assoc()){
                echo "<tr>
                            <th scope=\"row\">". $row["id"] ."</th>
                            <td><img src=\"". $row["carte_etudiante_image"] ."\" alt=\"image_etudiante\" width=\"200px\" height=\"200px\"></td>
                            <td>". $row["nom_prenom"] ."</td>
                            <td>". $row["matricule"] ."</td>
                            <td>". $row["programme"] ."</td>
                            <td><a href=\"modifier.php?id=" . $row["id"] . "\">X</a></td>
                            <td><a href=\"supprimer.php?id=".$row["id"]."\">X</a></td>
                        </tr>";
            }

            //close table and body
            echo        "</tbody>       
                    </table>";

            //Bouton qui renvoie vers ajouter.php
            echo "<form action=\"ajouter.php\" method=\"get\"><button type=\"submit\" class=\"btn btn-secondary m-5\">Ajouter</button>";

            //Bouton qui déconnecte la session
            ?>
            <button class="btn btn-secondary"><a href="login.php?action=disconnect" style="color:white;text-decoration:none;">Déconnection</a></button>
            <?php
        } 
        else 
        {
            echo "0 results";
        }
        $conn->close();
    }
    else{
        header("location: login.php?action=login");
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>