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
    <title>Connexion</title>
</head>
<body>
    <?php
    //Déclarer les données de départ
    if(isset($_GET['action'])){
        if($_GET['action'] == "login"){
            ?>
            <script>alert("Veuillez vous connecter");</script>
            <?php
        }else if($_GET['action'] == "disconnect"){
            session_unset();
            session_destroy();
        }
    }

    $mdp = ""; $user = ""; $nomErreur = "";
    $erreur = false;

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            echo "Connexion en cours...<br>";

            if(empty($_POST["courriel"])) {
                $nomErreur = "Veuillez entrer une adresse courriel";
                $erreur = true;
            } else if(empty($_POST["mdp"])) {
                $nomErreur = "Veuillez entrer un mot de passe";
                $erreur = true;
                if(!(empty($_POST["courriel"])))$user = $_POST["courriel"];
            } else {
                $user = $_POST["courriel"];
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

                $sql = "SELECT * FROM usagers WHERE email='$user' AND mdp='$mdp';";
                echo $sql;
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>Connecté</h1>";
                    $_SESSION["connexion"] = true;
                    header("location: index.php");
                }
                else {
                    $erreur = true;
                    $nomErreur = "<br>Nom d'usager ou mot de passe invalide";
                }
                $conn->close();
            }
            
        

        }
        //Demander à l'usager de se connecter
        if($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
            ?>
                <span style="color:red";><?php echo $nomErreur;?></span><br><br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="margin:5%;">
                    <div class="mb-3">
                        <label class="form-label">Courriel</label>
                        <input type="email" class="form-control" aria-describedby="emailHelp" style="width:35%;" name="courriel" value="<?php echo $user ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" style="width:35%;" name="mdp" value="<?php echo $mdp ?>">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label">Rester connecté</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                    <button class="btn btn-primary"><a href="creationUser.php" style="color:white;text-decoration:none;">Créer un compte</a></button>
                </form>
            
            
            
            
            <?php
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