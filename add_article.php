<?php
//imports des ressources
include 'vendor/autoload.php';
include 'tools.php';
include 'article.php';
include 'category.php';

//Démarrer la session PHP
session_start();

//Test si déconnecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

//test si le formulaire est submit
if (isset($_POST["submit"])) {
    //Test si les champs sont remplis
    if (
        !empty($_POST["title"]) &&
        !empty($_POST["content"])
    ) {
        //Nettoyer les entrées utilisateurs
        sanitize_array($_POST);
        //récupération id users (connecté)
        $_POST["id_users"] = $_SESSION["user"]["id"];
        //Ajouter l'article
        add_categorie_article($_POST);
        $message = "L'article " . $_POST["title"] . " a été ajouté en BDD";
    } else {
        $message = "Veuillez remplir tous les champs du formulaire";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Ajouter un article</title>
</head>

<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Saisir le titre">
            <textarea name="content" placeholder="Saisir le contenu de l'article"></textarea>
            <select aria-label="Sélectionner les categories..." multiple size="4" name="category[]">
                <option disabled>
                    Sélectionner les categories...
                </option>
                <!--Création de la liste des categories -->
                <?php foreach (get_all_categories() as $category) :?>
                    <option value="<?= $category["id"] ?>"><?= $category["name_category"] ?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" value="Ajouter" name="submit">
        </form>
        <p><?= $message ?? "" ?></p>
    </main>
</body>

</html>