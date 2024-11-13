<?php
// 1. Récupérer l'URL demandée
$requestUri = $_SERVER['REQUEST_URI'];

// Liste des routes
$routes = [
    '/' => 'Page d\'accueil',  // La route par défaut
    '/films' => 'Tous les films',
    '/contact' => 'Page de contact',
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
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

    <?php
    // Vérifie si l'URL correspond à une route définie
    if (array_key_exists($requestUri, $routes)) {
        // Affiche le contenu en fonction de la route
        echo "<p>" . $routes[$requestUri] . "</p>";
    } else {
        // Si la route n'existe pas, affiche une erreur
        echo "<p>Page non trouvée</p>";
    }
    ?>

</body>

<footer>
    <p><small>Copyright © 2024, All Right Reserved Adrien T.</small></p>
</footer>

</html>
