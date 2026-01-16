<?php
//Démarrer la session 
session_start();

//Test si l'utilisateur est déconnecté
if (!isset($_SESSION["user"])) {
    //Redirection
    header('Location: index.php');
    exit();
}
//import des ressources
include 'category.php';
include 'tools.php';

//test si le formulaire est soumis
if (isset($_POST['save'])) {
    //Test si les champs existent
    if (!empty($_POST['name'])) {
        //Sanitize des données
        sanitize_array($_POST);
        //Test si la catégorie existe
        if (is_category_exists($_POST['name'])) {
            $message =  "La catégorie existe déjà";
        }
        //Sinon
        else {
            //Ajout de la catégorie
            add_category($_POST);
            $message = "La catégorie : " . $_POST["name"] . " ajoutée avec succès";
        }
    }
    //Sinon les champs ne sont pas tous remplis
    else {
        $message = "Le nom de la catégorie est obligatoire";
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
    <title>Ajouter une catégorie</title>
</head>

<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <form action="" method="post">
            <fieldset>
                <label>
                    Nom de la catégorie
                    <input type="text" name="name" placeholder="saisir le nom de la catégorie">
                </label>
                <input type="submit" value="Enregistrer" name="save">
            </fieldset>
        </form>
        <p><?= $message ?? "" ?></p>
    </main>
</body>

</html>
