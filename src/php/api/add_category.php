<?php
header('Content-Type: application/json');

// Connexion à la base de données
$host = 'localhost';
$dbname = 'app-vente';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $data['nom'];
    $image = isset($data['image']) ? base64_decode($data['image']) : null;

    // Requête pour ajouter une catégorie
    $query = "INSERT INTO categorie (nom, image) VALUES (:nom, :image)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':image', $image, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Catégorie ajoutée avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de la catégorie']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>
