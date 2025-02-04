<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

$commande_id = $data['commande_id'];
$produits = $data['produits'];

$sql = "INSERT INTO produits_commandes (commande_id, produit_id, quantite, prix) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

foreach ($produits as $produit) {
    $produit_id = $produit['produit_id'];
    $quantite = $produit['quantite'];
    $prix = $produit['prix'];
    $stmt->bind_param("iiid", $commande_id, $produit_id, $quantite, $prix);
    $stmt->execute();
}

echo json_encode(['message' => 'Produits enregistrés avec succès']);

$stmt->close();
$conn->close();
?>
