<?php

include 'user.php';
include 'tools.php';

session_start();

if (isset($_POST['login'])) {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        //Nettoyage des données
        sanitize_array($_POST);

        //récupération du compte utilisateur
        $user = get_user_by_email($_POST['email']);

        //Test si l'utilisateur existe
        if ($user) {
            //Vérification du mot de passe
            if (password_verify($_POST['password'], $user['password'])) {
                //Création de la session utilisateur
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email'],
                    'roles' => $user['roles']
                ];
                //Redirection vers la page d'accueil
                header('Location: index.php');
                exit();
            } else {
                $message = "Les informations de connexion sont incorrectes.";
            }
        } else {
            $message = "Les informations de connexion sont incorrectes.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
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
    <title>Se connecter</title>
</head>

<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <h1>Se connecter</h1>
        <form method="post" action="">
            <fieldset>
                <label for="email">Email :
                    <input type="email" id="email" name="email" required>
                </label>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </fieldset>
            <input type="submit" value="Se connecter" name="login">
        </form>
        <?php
        if (isset($message)) {
            echo "<p>$message</p>";
        }
        ?>
</body>

</html>