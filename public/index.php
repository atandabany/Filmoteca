<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();
$router->route();

// Obtenir le contenu pour la route actuelle
$content = $router->route();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Filmoteca</title>
</head>
<body>
    <nav>
        <div class="navbar">
            <a href="/">Home</a>
            <a href="/films">Tous les films</a>
            <a href="/contact">Contact</a>
            <a href="#">Catégories</a>
            <a href="#">Acteurs</a>
            <a href="#">Réalisateurs</a>
            <a href="#">Login</a>
        </div>
    </nav>

    <h1>Bienvenue sur Filmoteca</h1>

    <p><?php echo $content; ?></p> <!-- Affichage du contenu ici -->

</body>

<footer>
    <p><small>Copyright © 2024, All Right Reserved Adrien T.</small></p>
</footer>

</html>
