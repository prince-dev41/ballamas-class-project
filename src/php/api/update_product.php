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

    $id = $data['id'];
    $nom = $data['nom'];
    $prix = $data['prix'];
    $stock = $data['stock'];
    $description = $data['description'];
    $image = isset($data['image']) ? base64_decode($data['image']) : null;
    $categorie_id = isset($data['categorie_id']) ? $data['categorie_id'] : null;

    // Requête pour mettre à jour un produit
    $query = "UPDATE produits SET nom = :nom, prix = :prix, stock = :stock, description = :description";
    if ($image) {
        $query .= ", image = :image";
    }
    if ($categorie_id !== null) {
        $query .= ", categories_id = :categorie_id";
    }
    $query .= " WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':description', $description);
    if ($image) {
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
    }
    if ($categorie_id !== null) {
        $stmt->bindParam(':categorie_id', $categorie_id);
    }
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Produit mis à jour avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du produit']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>
