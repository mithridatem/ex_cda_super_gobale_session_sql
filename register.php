<?php

session_start();

include 'user.php';
include 'tools.php';
//test si le formulaire est soumis
if (isset($_POST['register'])) {
    //Test si les champs existent
    if (
        !empty($_POST['firstname']) &&
        !empty($_POST['lastname']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password'])
    ) {
        //Sanitize des données
        sanitize_array($_POST);
        //Test si l'utilisateur existe
        if (is_user_exists($_POST['email'])) {
            $message =  "L'utilisateur existe déjà";
        }
        //Sinon on ajoute l'utilisateur
        else {
            //Hash du mot de passe
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //Récupération de l'image de profil si elle existe
            if (isset($_FILES["img"]) && !empty($_FILES["img"]["tmp_name"])) {
                $old_name = $_FILES["img"]["name"];
                $from = $_FILES["img"]["tmp_name"];
                $ext = getFileExtension($old_name);
                $new_name = uniqid($_POST["firstname"],true) . "." .$ext;
                $to = __DIR__ . "/public/" . $new_name;
                //Déplacement de l'image (vers public)
                move_uploaded_file($from, $to);
                //Renommer l'image dans la super gobale $_POST["img]
                $_POST["img"] = $new_name;
            }     
            //sinon image par défault
            else {
                $_POST["img"] = "default.png";
            }
            //Ajout de l'utilisateur
            add_user($_POST);
            $message = "Utilisateur ajouté avec succès";
        }
    }
    //Sinon les champs ne sont pas tous remplis
    else {
        $message = "Tous les champs sont obligatoires";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>S'inscrire</title>
</head>

<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <h1>S'inscrire</h1>
        <p><?= $message ?? "" ?></p>
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="firstname">Prénom
                    <input type="text" id="firstname" name="firstname" placeholder="saisir le prénom">
                </label>
                <label for="lastname">Nom
                    <input type="text" id="lastname" name="lastname" placeholder="saisir le nom">
                </label>
                <label for="email">Email
                    <input type="email" id="email" name="email" placeholder="saisir l'email" aria-required="true">
                </label>
                <label for="password">Mot de passe
                    <input type="password" id="password" name="password" placeholder="saisir le mot de passe" aria-required="true">
                </label>
                <label for="">Ajouter une image de profil :</label>
                <input type="file" name="img">
                <label for="roles">
                    <input type="checkbox" id="roles" name="roles" aria-label="Rôle administrateur">
                    Cocher pour rôle admin
                </label>
            </fieldset>
            <input type="submit" value="S'inscrire" name="register">
        </form>
        
    </main>
</body>

</html>