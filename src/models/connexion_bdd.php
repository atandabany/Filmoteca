<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "movie_bdd"; 

// la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// vérifie la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}
?>