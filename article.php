<?php

include 'bdd.php';

/**
 * Méthode pour ajouter un article en BDD
 * @param array $article (super globale POST)
 * @return int $id id de l'article ajouté en BDD
 */
function add_article(array $article): int
{
    try {
        //1 Connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête SQL
        $sql = "INSERT INTO article(title, content, id_users) VALUE(?,?,?)";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindValue(1, $article["title"], PDO::PARAM_STR);
        $req->bindValue(2, $article["content"], PDO::PARAM_STR);
        //$req->bindValue(3, $article["created_at"], PDO::PARAM_STR);
        $req->bindValue(3, $article["id_users"], PDO::PARAM_INT);
        //5 Exécuter la requête
        $req->execute();
        //récupération du dernier id ajouté
        $id = $bdd->lastInsertId();
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
    return $id;
}

/**
 * Méthode pour ajouter une catégorie à un article en BDD
 * @param int $id_category id de la categorie
 * @param int $id_article id de la categorie
 * @return void
 */
function add_article_category(int $id_category, int $id_article): void
{
    try {
        //1 Connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête SQL
        $sql = "INSERT INTO article_category(id_article, id_category) VALUE(?,?)";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindParam(1, $id_article, PDO::PARAM_INT);
        $req->bindParam(2, $id_category, PDO::PARAM_INT);
        //5 Exécuter la requête
        $req->execute();
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}

/**
 * Méthode pour ajouter un article et les categories en BDD
 * @param array $article (super globale POST)
 * @return void
 */
function add_categorie_article(array $article): void 
{
    try {
        //ajout de l'article
        $id_article = add_article($article);
        //Ajouter les categories
        foreach ($article["category"] as $key => $value) {
            //Ajout de la categorie en BDD
            add_article_category($value,$id_article);
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}