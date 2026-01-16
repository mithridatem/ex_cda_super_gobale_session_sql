<?php

include 'bdd.php';

/**
 * Ajoute une catégorie en base de données
 * @param array $category Tableau associatif contenant les informations de la catégorie
 * @return void
 */
function add_category(array $category): void
{
    try {
        //1 Connexion à la BDD
        $bdd = connect_bdd();
        //2 Ecriture de la requête
        $sql = "INSERT INTO category (name_category) VALUES (?)";
        //3 Préparation de la requête
        $req = $bdd->prepare($sql);
        //4 Bind des valeurs
        $req->bindValue(1, $category['name'], PDO::PARAM_STR);
        //5 Exécution de la requête
        $req->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

/**
 * Vérifie si une catégorie existe en fonction de son nom
 * @param string $name Nom de la catégorie
 * @return bool Retourne true si la catégorie existe, false sinon
 */
function is_category_exists(string $name): bool
{
    try {
        //1 Connexion à la BDD
        $bdd = connect_bdd();
        //2 Ecriture de la requête
        $sql = "SELECT c.id FROM category AS c WHERE name_category = ?";
        //3 Préparation de la requête
        $req = $bdd->prepare($sql);
        //4 Bind des valeurs
        $req->bindValue(1, $name, PDO::PARAM_STR);
        //5 Exécution de la requête
        $req->execute();
        //7 Retourne true si la catégorie existe, false sinon
        return (bool) $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}
