<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer</title>
</head>
<body>
    <?php
        $id = $_GET["id"];

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

        //requête sql
        $sql = "DELETE FROM etudiants WHERE id=$id";
        //action (query)
        $result = $conn->query($sql);
        if(mysqli_query($conn, $sql)){
            echo "supprimage réussi";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        echo "sql=".$sql."<br><br>";

        echo "Clickez <a href=\"index.php\">ici</a> pour retourner au menu principal.";

    ?>
</body>
</html>