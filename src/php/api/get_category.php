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

// Récupérer l'ID de la catégorie depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die(json_encode(["error" => "ID de catégorie invalide"]));
}

// Requête SQL pour récupérer une catégorie spécifique
$sql = "SELECT id, nom, description, image FROM Categorie WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$category = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['image'])) {
        $row['image'] = "data:image/jpeg;base64," . base64_encode($row['image']); // Ajout du type MIME
    } else {
        $row['image'] = null; // Si aucune image
    }
    $category = $row;
} else {
    die(json_encode(["error" => "Catégorie non trouvée"]));
}

// Envoyer la réponse JSON
echo json_encode($category, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$stmt->close();
$conn->close();
?>
