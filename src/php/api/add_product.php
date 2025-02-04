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

    $nom = isset($data['nom']) ? $data['nom'] : '';
    $prix = isset($data['prix']) ? $data['prix'] : 0;
    $stock = isset($data['stock']) ? $data['stock'] : 0;
    $description = isset($data['description']) ? $data['description'] : '';
    $image = isset($data['image']) ? base64_decode($data['image']) : null;
    $categorie_id = isset($data['categorie_id']) ? $data['categorie_id'] : null;

    // Vérifier que tous les paramètres nécessaires sont définis
    if (empty($nom) || empty($prix) || empty($stock) || empty($description) || empty($categorie_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Paramètres manquants ou invalides']);
        exit;
    }

    // Requête pour ajouter un produit
    $query = "INSERT INTO produits (nom, prix, stock, description, image, categories_id) VALUES (:nom, :prix, :stock, :description, :image, :categorie_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    $stmt->bindParam(':categorie_id', $categorie_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Produit ajouté avec succès']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du produit']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>
