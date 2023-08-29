<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- Connection à la BD -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "chiens";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conne->connect_error);
    }
    echo "Connected successfully <br>";

    //ca fait rien ca fait juste créer un string avec une requete
    $sql = "SELECT * FROM chiens";
    
    //L'action, la query est ici
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()){
            //Faire un bel affichage de notre data
            echo "id: " . $row["id"] . " - Race: " . $row["race"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

    ?>
</body>
</html>