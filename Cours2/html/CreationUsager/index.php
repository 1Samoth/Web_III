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
    //On crée les variables du formulaire vide
    $nom = $mdp = $mdp_confirmer = $email = $image_profil = $sexe = $date_naissance = $moyen_transport = "";

    //On crée les variables d'erreurs vides
    $nomErreur = "";


    //La variable qui permet de savoir s'il y a au moins une erreur dans le formulaire
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";
        //Si on entre, on est dans l'envoie du formulaire
        
        if(empty($_POST['nom']) || empty($_POST['mdp']) || empty($_POST['mdp_confirmer']) || empty($_POST['email']) || empty($_POST['image_profil']) || empty($_POST['sexe']) || empty($_POST['moyen_transport'])){
            $nomErreur = "Veuillez remplir tout les champs obligatoires (*)";
            $erreur = true;

            //Garder les valeurs remplies par l'usager avant la soumission
            if(!empty($_POST['nom'])) $nom=test_input($_POST['nom']);
            if(!empty($_POST['email'])) $email=test_input($_POST['email']);
            if(!empty($_POST['image_profil'])) $image_profil=test_input($_POST['image_profil']);
            if(!empty($_POST['sexe'])) $sexe=test_input($_POST['sexe']);
            if(!empty($_POST['date_naissance'])) $date_naissance=test_input($_POST['date_naissance']);
            if(!empty($_POST['moyen_transport'])) $moyen_transport=test_input($_POST['moyen_transport']);
        }
        //Vérifier si le sexe/moyen_transport a été choisi
        elseif(!(isset($_POST["sexe"]) || isset($_POST["moyen_transport"]))){
            $nomErreur = "Veuillez remplir tout les champs obligatoires (*)";
            $erreur = true;

            //Garder les valeurs remplies par l'usager avant la soumission
            if(!empty($_POST['nom'])) $nom=test_input($_POST['nom']);
            if(!empty($_POST['email'])) $email=test_input($_POST['email']);
            if(!empty($_POST['image_profil'])) $image_profil=test_input($_POST['image_profil']);
            if(!empty($_POST['sexe'])) $sexe=test_input($_POST['sexe']);
            if(!empty($_POST['date_naissance'])) $date_naissance=test_input($_POST['date_naissance']);
            if(!empty($_POST['moyen_transport'])) $moyen_transport=test_input($_POST['moyen_transport']);
        }
        //Nom déjà pris (SLAY)
        elseif($_POST['nom']=='SLAY') {
            $nomErreur = "Nom d'usager indisponible";
            $erreur = true;

            //Garder les valeurs remplies par l'usager avant la soumission
            if(!empty($_POST['email'])) $email=test_input($_POST['email']);
            if(!empty($_POST['image_profil'])) $image_profil=test_input($_POST['image_profil']);
            if(!empty($_POST['sexe'])) $sexe=test_input($_POST['sexe']);
            if(!empty($_POST['date_naissance'])) $date_naissance=test_input($_POST['date_naissance']);
            if(!empty($_POST['moyen_transport'])) $moyen_transport=test_input($_POST['moyen_transport']);
        
        //mdp et mdp_confirmation identiques?
        }elseif($_POST['mdp'] != $_POST['mdp_confirmer']) {
            
            $nomErreur = "Le mot de passe et la confirmation de celui-ci doivent être identiques";
            $erreur = true;

            //Garder les valeurs remplies par l'usager avant la soumission
            if(!empty($_POST['nom'])) $nom=test_input($_POST['nom']);
            if(!empty($_POST['email'])) $email=test_input($_POST['email']);
            if(!empty($_POST['image_profil'])) $image_profil=test_input($_POST['image_profil']);
            if(!empty($_POST['sexe'])) $sexe=test_input($_POST['sexe']);
            if(!empty($_POST['date_naissance'])) $date_naissance=test_input($_POST['date_naissance']);
            if(!empty($_POST['moyen_transport'])) $moyen_transport=test_input($_POST['moyen_transport']);
        }
        else{

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $nomErreur = "Veuillez entrer une adresse courriel valide.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);
        }
        else{
            
            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);
        }


        // Inserer dans la base de données
        //SI erreurs, on réaffiche le formulaire 
        }
    if($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois";

    ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
            
            <span style="color:red";><?php echo $nomErreur;?></span><br><br>

            <label for="nom">*Nom usager : </label><input type="text" name="nom" value="<?php echo $nom ?>"><br>
            <label for="mdp">*Mot de passe : </label><input type="password" name="mdp" value="<?php echo $mdp ?>"><br>
            <label for="mdp_confirmation">*Confirmation du mot de passe : </label><input type="password" name="mdp_confirmer" value="<?php echo $mdp_confirmer ?>"><br>
            <label for="email">*Adresse courriel : </label><input type="email" name="email" value="<?php echo $email ?>"><br>
            <label for="image_profil">*Photo de profil : </label><input type="url" name="image_profil" value="<?php echo $image_profil ?>"><br>
            <label>*Sexe :  </label><input type="radio" name="sexe" value="F"> F <input type="radio" name="sexe" value="M"> M <input type="radio" name="sexe" value="Autre" checked="checked"> Autre <br>
            <label for="date_naissance">Date de naissance : </label><input type="date" name="date_naissance" value="<?php echo $date_naissance ?>"><br>
            <label>*Moyen de transport : </label><input type="radio" name="moyen_transport" value="Auto"> Auto
                                  <input type="radio" name="moyen_transport" value="Autobus"> Autobus
                                  <input type="radio" name="moyen_transport" value="Marche"> Marche
                                  <input type="radio" name="moyen_transport" value="Vélo"> Vélo
                                  <input type="radio" name="moyen_transport" value="Autre" checked="checked"> Autre<br>


            <br><input type="submit">
        </form>

    <?php
    }
    else{
    ?>
        
        <div class="card" style="width: 18rem; margin-left:100px;">
            <img src="<?php echo($_POST["image_profil"]) ?>" class="card-img-top" alt="image_profil">
            <div class="card-body">
                <h5 class="card-title"><?php echo($_POST["nom"]) ?></h5>
                <p class="card-text">Du texte pour remplir la description du profil oui c'est du texte c'est bien vrai. C'est du texte qui a comme but de remplir la description de votre compte c'est bien ça.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">email: <?php echo($_POST["email"]) ?></li>
                <li class="list-group-item">sexe: <?php echo($_POST["sexe"]) ?></li>
                <li class="list-group-item">date de naissance: <?php echo($_POST["date_naissance"]) ?></li>
                <li class="list-group-item">transport principal: <?php echo($_POST["moyen_transport"]) ?></li>
            </ul>
        </div>

        <!--Créer un nouvel usager (retour au formulaire-->
        <form action="index.php"><input type="submit" value="Créer un nouvel usager" name="go_back" style="margin-left:100px; margin-top:10px;"></form>

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