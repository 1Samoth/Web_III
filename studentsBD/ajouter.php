<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Ajouter</title>
</head>
<body>
    <?php
    //Définir les variables de la table
    $nom_prenom = $matricule = $programme = $carte_etudiante_image = "";
    $erreur = false;
    $nomErreur = "";


    

    
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
            
            <span style="color:red";><?php echo $nomErreur;?></span><br><br>
            <div class="mb-3 form-check" style="max-width:30%;">
                <label for="nom_prenom" class="form-label">Nom, Prénom : </label>
                <input type="text" class="form-control" name="nom_prenom" value="<?php echo $nom_prenom ?>">
            </div>
            <div class="mb-3 form-check" style="max-width:30%;">
                <label for="matricule" class="form-label">Matricule : </label>
                <input type="text" class="form-control" name="matricule" value="<?php echo $matricule ?>">
            </div>
            <div class="mb-3 form-check" style="max-width:30%;">
                <label for="programme" class="form-label">Programme : </label>
                <input type="text" class="form-control" name="programme" value="<?php echo $programme ?>">
            </div>
            <div class="mb-3 form-check" style="max-width:30%;">
            <label for="carte_etudiante_image" class="form-label">Photo Étudiante : </label>
                <input type="text" class="form-control" name="carte_etudiante_image" value="<?php echo $carte_etudiante_image ?>">
            </div>
            <button type="submit" class="btn btn-primary mx-4">Soumettre</button>
        </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") 
    {
        
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


    
        $sql = "INSERT INTO etudiants (id, nom_prenom, matricule, programme, carte_etudiante_image)
        VALUES(NULL, '". $_POST['nom_prenom'] ."','". $_POST['matricule'] ."','". $_POST['programme'] ."','". $_POST['carte_etudiante_image'] ."')";

        echo "sql=" . $sql . "<br><br><br>";

        if(mysqli_query($conn, $sql)){
            echo "enregistrement réussi";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
        

    if(mysqli_query($conn, $sql)){
        echo "enregistrement réussi";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    echo $sql;
    
    }














    function test_input($data){
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>