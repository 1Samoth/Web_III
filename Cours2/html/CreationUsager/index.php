<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }elseif($_POST['mdp'] != $_POST['mdp_confirmation']) {
            $nomErreur = "Le mot de passe et la confirmation de celui-ci doivent être identiques";
            $erreur = true;

            //Garder les valeurs remplies par l'usager avant la soumission
           /* if(!empty($_POST['nom'])) $nom=test_input($_POST['nom']);
            if(!empty($_POST['email'])) $email=test_input($_POST['email']);
            if(!empty($_POST['image_profil'])) $image_profil=test_input($_POST['image_profil']);
            if(!empty($_POST['sexe'])) $sexe=test_input($_POST['sexe']);
            if(!empty($_POST['date_naissance'])) $date_naissance=test_input($_POST['date_naissance']);
            if(!empty($_POST['moyen_transport'])) $moyen_transport=test_input($_POST['moyen_transport']);*/
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

            *Nom usager : <input type="text" name="nom" value="<?php echo $nom ?>"><br>
            *Mot de passe : <input type="password" name="mdp" value="<?php echo $mdp ?>"><br>
            *Confirmation du mot de passe : <input type="password" name="mdp_confirmer" value="<?php echo $mdp_confirmer ?>"><br>
            *Adresse courriel : <input type="email" name="email" value="<?php echo $email ?>"><br>
            *Photo de profil : <input type="url" name="image_profil" value="<?php echo $image_profil ?>"><br>
            *Sexe :  <input type="radio" name="sexe" value="F"> F <input type="radio" name="sexe" value="M"> M<br>
            *Date de naissance : <input type="date" name="date_naissance" value="<?php echo $date_naissance ?>"><br>
            *Moyen de transport : <input type="radio" name="moyen_transport" value="Auto"> Auto
                                  <input type="radio" name="moyen_transport" value="Autobus"> Autobus
                                  <input type="radio" name="moyen_transport" value="Marche"> Marche
                                  <input type="radio" name="moyen_transport" value="Vélo"> Vélo<br>


            <br><input type="submit">
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

    
</body>
</html>



    <!--
        if(empty($_POST['nom'])){
            $nomErreur = "Veuillez préciser un nom.";
            $erreur = true;

            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['mdp'])){
            $nomErreur = "Veuillez préciser un mot de passe.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['mdp_confirmer'])){
            $nomErreur = "Veuillez confirmer votre mot de passe.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['email'])){
            $nomErreur = "Veuillez préciser une addresse courriel.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['image_profil'])){
            $nomErreur = "Veuillez choisir une image profil.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['sexe'])){
            $nomErreur = "Veuillez préciser votre sexe.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $date_naissance = test_input($_POST["date_naissance"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['date_naissance'])){
            $nomErreur = "Veuillez préciser une date de naissance.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $moyen_transport = test_input($_POST["moyen_transport"]);

        }elseif(empty($_POST['moyen_transport'])){
            $nomErreur = "Veuillez préciser un moyen de transport.";
            $erreur = true;

            $nom = test_input($_POST["nom"]);
            $mdp = test_input($_POST["mdp"]);
            $mdp_confirmer = test_input($_POST["mdp_confirmer"]);
            $email = test_input($_POST["email"]);
            $image_profil = test_input($_POST["image_profil"]);
            $sexe = test_input($_POST["sexe"]);
            $date_naissance = test_input($_POST["date_naissance"]);

        }else{
            $erreur = false;
            $nomErreur = "";
        }
    -->