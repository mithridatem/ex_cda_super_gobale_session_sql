<?php
include 'vendor/autoload.php';
/**
 * Méthode qui retourne l'extension d'un fichier
 * @param string $file nom du fichier
 * @return string extension du fichier
 */
function getFileExtension($file)
{
    return substr(strrchr($file, '.'), 1);
}

if (isset($_POST["submit"])) {
    //test si le fichier est bien importé
    if (isset($_FILES["fichier"]) && !empty($_FILES["fichier"]["tmp_name"])) {
        //Récupération du fichier (variable)
        $name = $_FILES["fichier"]["name"];
        $temp = $_FILES["fichier"]["tmp_name"];
        //Récupération de l'extension en minuscule
        $ext =  strtolower(getFileExtension($name));
        //test extension du fichier
        if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
            //test si le fichier est plus grand que :
            if ($_FILES["fichier"]["size"] > (1024*1204)) {
                echo "le fichier est trop grand";
            } else {
                //renommer le fichier
                $new_name = uniqid("fichier", true);
                $new_name = "public/" . $new_name . "." . $ext;
                //déplacement
                move_uploaded_file($temp, $new_name);
            }
        } else {
            echo "Le format est invalide";
        }
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
    <title>import</title>
</head>
<body>
    <main class="container-fluid">
        <h1>Import de fichier</h1>
        <form action="" method="post" enctype="multipart/form-data">
        <label for="">Importer un fichier</label>    
        <input type="file" name="fichier">
        <input type="submit" value="importer" name="submit">
        </form>
    </main>
</body>
</html>