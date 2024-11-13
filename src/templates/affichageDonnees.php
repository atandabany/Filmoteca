<?php
include 'connexion_bdd.php';

$sql = "SELECT * FROM movie"; // la requete
$result = $conn->query($sql); // l'execution de la requete

if ($result->num_rows > 0) {
    // Afficher chaque ligne de données dans le tableau
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["title"] . "</td>
                <td>" . $row["year"] . "</td>
                <td>" . $row["synopsis"] . "</td>
                <td>" . $row["director"] . "</td>
                <td>" . $row["created-at"] . "</td>
                <td>" . $row["deleted-at"] . "</td>
                <td>" . $row["genre"] . "</td>
              </tr>";
    }
} 

$conn->close();
?>
