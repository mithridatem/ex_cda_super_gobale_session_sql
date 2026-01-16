<?php
//import de la librairie Dotenv pour gérer les variables d'environnement
require 'vendor/autoload.php';
use Dotenv\Dotenv;

//chargement des variables d'environnement depuis le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Méthode pour se connecter à la BDD
 * @return PDO retourne un objet de connexion PDO
 */
function connect_bdd(): PDO
{
    return new PDO('mysql:host='. $_ENV["DB_HOST"] . ';dbname='. $_ENV["DB_NAME"] . '',
    $_ENV["DB_USERNAME"], 
    $_ENV["DB_PASSWORD"],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
