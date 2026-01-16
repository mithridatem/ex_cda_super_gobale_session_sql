<?php

//lance la session
session_start();

//Test si l'utilisateur est déconnecté
if (!isset($_SESSION["user"])) {
    //Redirection
    header('Location: index.php');
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Profil</title>
</head>
<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <h2>Prénom : <?= $_SESSION["user"]["firstname"] ?? "" ?></h2>
        <h2>Nom : <?= $_SESSION["user"]["lastname"] ?? "" ?></h2>
        <h2>Email : <?= $_SESSION["user"]["email"] ?? "" ?></h2>
    </main>
</body>
</html>
