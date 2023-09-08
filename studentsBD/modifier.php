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
    <title>Modifier</title>
</head>
<body>
    <?php
    if($_SESSION["connexion"] == true){
            //1 - Récupérer le ID
            $nom_prenom = $matricule = $programme = $carte_etudiante_image = "";
            if($_SERVER["REQUEST_METHOD"] != "POST")
            { $id = $_GET['id']; } 
            
            $nomErreur = "";
            $erreur = false;

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
            
            
            //sélectionner le data dans la bd
            if($_SERVER["REQUEST_METHOD"] != "POST")
            $sql = "SELECT * FROM etudiants WHERE id=$id";
            

            //vérification du formulaire un fois le data ajouté
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "Vérification des données...<br>";
        
                if(empty($_POST['nom_prenom'])){
                    $nomErreur = "Veuillez fournir un nom, prénom.";
                    $erreur = true;
        
                    
                    if(!empty($_POST["matricule"]))$matricule = test_input($_POST["matricule"]);
                    if(!empty($_POST["programme"]))$programme = test_input($_POST["programme"]);
                    if(!empty($_POST["carte_etudiante_image"]))$carte_etudiante_image = test_input($_POST["carte_etudiante_image"]);
                }
                else if(empty($_POST['matricule'])){
                    $nomErreur = "Veuillez fournir un matricule.";
                    $erreur = true;
        
                    if(!empty($_POST["nom_prenom"]))$nom_prenom = test_input($_POST["nom_prenom"]);
                    if(!empty($_POST["programme"]))$programme = test_input($_POST["programme"]);
                    if(!empty($_POST["carte_etudiante_image"]))$carte_etudiante_image = test_input($_POST["carte_etudiante_image"]);
                }
                else if(empty($_POST['programme'])){
                    $nomErreur = "Veuillez fournir votre programme.";
                    $erreur = true;
        
                    if(!empty($_POST["nom_prenom"]))$nom_prenom = test_input($_POST["nom_prenom"]);
                    if(!empty($_POST["matricule"]))$matricule = test_input($_POST["matricule"]);
                    if(!empty($_POST["carte_etudiante_image"]))$carte_etudiante_image = test_input($_POST["carte_etudiante_image"]);
                }
                else if(empty($_POST["carte_etudiante_image"])){
                    $nomErreur = "veuillez fournir votre carte éudiante.";
                    $erreur = true;
        
                    if(!empty($_POST["nom_prenom"]))$nom_prenom = test_input($_POST["nom_prenom"]);
                    if(!empty($_POST["matricule"]))$matricule = test_input($_POST["matricule"]);
                    if(!empty($_POST["programme"]))$programme = test_input($_POST["programme"]);
                }
                else
                {
                    echo "Vérification réussie...<br>";
                    $erreur = false;
                    $nomErreur = "";
                }
                
            }


        
        if($_SERVER["REQUEST_METHOD"] != "POST"){

            $result = $conn->query($sql);

            if($result->num_rows > 0){
            $row = $result->fetch_assoc();
        ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <?php if($erreur == true){ echo "<span style=\"color:red\";><?php echo $nomErreur;?></span><br><br>"; } ?>
                
                </div>
                <div class="mb-3 form-check" style="max-width:30%;">
                    <label for="nom_prenom" class="form-label">Nom, Prénom : </label>
                    <input type="text" class="form-control" name="nom_prenom" value="<?php echo $row['nom_prenom'] ?>">
                </div>
                <div class="mb-3 form-check" style="max-width:30%;">
                    <label for="matricule" class="form-label">Matricule : </label>
                    <input type="text" class="form-control" name="matricule" value="<?php echo $row['matricule'] ?>">
                </div>
                <div class="mb-3 form-check" style="max-width:30%;">
                    <label for="programme" class="form-label">Programme : </label>
                    <input type="text" class="form-control" name="programme" value="<?php echo $row['programme'] ?>">
                </div>
                <div class="mb-3 form-check" style="max-width:30%;">
                <label for="carte_etudiante_image" class="form-label">Photo Étudiante : </label>
                    <input type="text" class="form-control" name="carte_etudiante_image" value="<?php echo $row['carte_etudiante_image'] ?>">
                </div>
                    <input type="hidden" class="form-control" name="id_post" value="<?php echo $row['id'] ?>">
                
                <button type="submit" class="btn btn-primary mx-4">Soumettre</button>
                <button class="btn btn-primary mx-4"><a href='index.php' style="color:white; text-decoration:none;">Retour</a></button>
            </form>

        <?php
            //fin de la vérification données 
            }
            else
            {
                echo "Erreur. Cliquez <a href=\"index.php\">ici</a> pour réessayer";
            }

        //fin de la verification POST
        }


        

            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {

                echo "Modification en cours...<br><br>";
                $sql = "UPDATE etudiants 
                        SET nom_prenom=\"".$_POST["nom_prenom"]."\", matricule=\"".$_POST["matricule"]."\", programme=\"".$_POST["programme"]."\", carte_etudiante_image=\"".$_POST["carte_etudiante_image"]."\"
                        WHERE id=\"".$_POST["id_post"]."\";";
        
                if(mysqli_query($conn, $sql)){
                header('Location: http://localhost/Web_III/studentsBD/index.php?action=reussi');
                
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                
            }
        }
        else{
            header("location: login.php?action=login");
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