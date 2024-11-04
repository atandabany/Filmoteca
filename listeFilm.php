<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste Films</title>
</head>
<body>
    <h1>Liste Films</h1>

    <table>
        <tr>
            <th>Titre</th>
            <th>Année</th>
            <th>Synopsis</th>
            <th>Réalisateur</th>
            <th>Créé le </th>
            <th>Supprimé le</th>
            <th>Genre</th>
        </tr>
        
        <?php include 'affichageDonnees.php'; ?>


    </table>
</body>
</html>