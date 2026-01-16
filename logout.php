<?php

// démarrage de la session
session_start();

// destruction de la session
session_destroy();

// redirection vers la page de connexion
header('Location: login.php');
exit();
