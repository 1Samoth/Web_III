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
    <title>Document</title>
</head>
<body>
    <?php
        $mdp = ""; $user = ""; $email = ""; $nomErreur = "";
        $erreur = false;

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            echo "Connexion en cours...<br>";

            if(empty($_POST["user"])) {
                $nomErreur = "Veuillez entrer un nom d'utilisateur";
                $erreur = true;
                if(!(empty($_POST["email"])))$mdp = $_POST["email"];
            } else if(empty($_POST["email"])) {
                $nomErreur = "Veuillez entrer une adresse courriel";
                $erreur = true;
                if(!(empty($_POST["user"])))$user = $_POST["user"];
            } else if(empty($_POST["mdp"])) {
                $nomErreur = "Veuillez entrer un mot de passe";
                $erreur = true;
                if(!(empty($_POST["email"])))$email = $_POST["email"];
                if(!(empty($_POST["user"])))$user = $_POST["user"];
            } else {
                $user = $_POST["user"];
                $email = $_POST["email"];
                $mdp = $_POST["mdp"];

                $mdp = sha1($mdp, false);
            
                //Vérifier si l'usager est dans la BD & Activer la session
                $servername = "localhost";
                $usernameDB = "root";
                $passwordDB = "root";
                $dbname = "students";

                //Create connection
                $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
                //Check connection
                if($conn->connect_error){
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO usagers(id, user, email, mdp, ip, machine) VALUES(NULL, '". $user ."','". $email ."','". $mdp ."', '', '');";
                
                echo "sql=" . $sql . "<br><br><br>";


                if(mysqli_query($conn, $sql)){
                    header('Location: http://localhost/Web_III/studentsBD/login.php?action=login');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                
            }
        }
    if($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        ?>
            <span style="color:red";><?php echo $nomErreur;?></span><br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="margin:5%;">
            <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" style="width:35%;" name="user" value="<?php echo $user ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Courriel</label>
                    <input type="email" class="form-control" aria-describedby="emailHelp" style="width:35%;" name="email" value="<?php echo $email ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" style="width:35%;" name="mdp" value="<?php echo $mdp ?>">
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        <?php
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>