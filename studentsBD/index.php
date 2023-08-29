<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<!-- Connection à la BD -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "students";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conne->connect_error);
    }
    echo "Connected successfully <br>";

    //ca fait rien ca fait juste créer un string avec une requete
    $sql = "SELECT * FROM etudiants";
    
    //L'action, la query est ici
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()){
            //Faire un bel affichage de notre data
            echo "id: " . $row["id"] . " - Nom, Prénom: " . $row["nom_prenom"] . " - Matricule: " . $row["matricule"] . " - Programme: " . $row["programme"] . "<br>Photo étudiante: " . $row["carte_etudiante_image"] . "<br><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>