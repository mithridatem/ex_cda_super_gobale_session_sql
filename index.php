<?php 

session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Accueil</title>
</head>

<body>
    <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <h1>Bienvenue sur notre site</h1>
        <p>Ceci est la page d'accueil.</p>
    </main>
</body>

</html>