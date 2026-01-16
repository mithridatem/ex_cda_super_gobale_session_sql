<?php

/**
 * Sanitize une chaîne de caractères
 * @param string $str Chaîne à nettoyer
 * @return string Chaîne nettoyée
 */
function sanitize(string $str): string
{
    //Supprimer les espaces devant
    $str = trim($str);
    //Supprimer les balises html
    $str = strip_tags($str);
    //supprimer des caractères
    $str = htmlspecialchars($str, ENT_NOQUOTES);
    return $str;
}
/**
 * Sanitize un tableau de données
 * @param array $data Tableau de données à nettoyer
 * @return void
 */
function sanitize_array(array &$data): void
{
    foreach ($data as $key => $value) {
        //Test si la colonne est un tableau
        if (gettype($value) === 'array') {
            sanitize_array($value);
        } else {
            $data[$key] =  sanitize($value);
        }
    }
}
