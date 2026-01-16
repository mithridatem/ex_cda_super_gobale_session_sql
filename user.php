<?php

include 'bdd.php';
/**
 * Ajoute un utilisateur en base de données
 * @param array $user Tableau associatif contenant les informations de l'utilisateur
 * @return void
 */
function add_user(array $user): void
{
    try {
        //1 Connexion à la BDD
        $bdd = connect_bdd();
        //2 Ecriture de la requête
        $sql = "INSERT INTO users (firstname, lastname, email, `password`, roles) VALUES (?,?,?,?,?)";
        //3 Préparation de la requête
        $req = $bdd->prepare($sql);
        //4 Bind des valeurs
        $req->bindValue(1, $user['firstname'], PDO::PARAM_STR);
        $req->bindValue(2, $user['lastname'], PDO::PARAM_STR);
        $req->bindValue(3, $user['email'], PDO::PARAM_STR);
        $req->bindValue(4, $user['password'], PDO::PARAM_STR);
        //Test du rôle
        if (isset($user['roles']) && $user['roles'] === 'on') {
            $req->bindValue(5, 'ROLE_ADMIN', PDO::PARAM_STR);
        } else {
            $req->bindValue(5, 'ROLE_USER', PDO::PARAM_STR);
        }
        //5 Exécution de la requête
        $req->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

/**
 * Vérifie si un utilisateur existe en fonction de son email
 * @param string $email Email de l'utilisateur
 * @return bool Retourne true si l'utilisateur existe, false sinon
 */
function is_user_exists(string $email): bool
{
    try {
        //1 Connexion à la BDD
        $bdd = connect_bdd();
        //2 Ecriture de la requête
        $sql = "SELECT u.id FROM users AS u WHERE email = ?";
        //3 Préparation de la requête
        $req = $bdd->prepare($sql);
        //4 Bind des valeurs
        $req->bindValue(1, $email, PDO::PARAM_STR);
        //5 Exécution de la requête
        $req->execute();
        //6 Récupération de l'utilisateur
        return (bool) $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Récupère un utilisateur en fonction de son email
 * @param string $email Email de l'utilisateur
 * @return array|null Retourne un tableau associatif 
 * contenant les informations de l'utilisateur ou null s'il n'existe pas
 */
function get_user_by_email(string $email): ?array
{
    try {
        //1 Connexion à la BDD
        $bdd = connect_bdd();
        //2 Ecriture de la requête
        $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.password, u.roles 
        FROM users AS u WHERE email = ?";
        //3 Préparation de la requête
        $req = $bdd->prepare($sql);
        //4 Bind des valeurs
        $req->bindValue(1, $email, PDO::PARAM_STR);
        //5 Exécution de la requête
        $req->execute();
        //6 Récupération de l'utilisateur
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //7 Retourne l'utilisateur ou null s'il n'existe pas
        return $user ?: null;
    } catch (PDOException $e) {
        return null;
    }
}
