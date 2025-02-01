<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-vente";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die(json_encode(["error" => "Échec de la connexion : " . $conn->connect_error]));
}

// Requête SQL
$sql = "SELECT id, nom, description, image FROM Categorie";
$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['image'])) {
            $row['image'] = "data:image/jpeg;base64," . base64_encode($row['image']); // Ajout du type MIME
        } else {
            $row['image'] = null; // Si aucune image
        }
        $categories[] = $row;
    }
}

// Envoyer la réponse JSON
echo json_encode($categories, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$conn->close();
?>
