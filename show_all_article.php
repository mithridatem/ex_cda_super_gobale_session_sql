<?php
include 'vendor/autoload.php';
//include 'tools';
include 'article.php';

$articles = get_all_articles();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Afficher les articles </title>
</head>

<body>
     <header class="container-fluid">
        <?php include 'navbar.php'; ?>
    </header>
    <main class="container-fluid">
        <table>
            <thead>
                <tr>
                    <th scope="col">title</th>
                    <th scope="col">content</th>
                    <th scope="col">created_at</th>
                    <th scope="col">categories</th>
                </tr>
            </thead>
            <tbody>
                
            <?php foreach ($articles as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $value["title"] ?></th>
                    <td><?= $value["content"] ?></td>
                    <td><?= $value["created_at"] ?></td>
                    <td><?= $value["name_category"] ?></td>
                </tr>
            <?php endforeach ?>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </main>
</body>

</html>