<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id']) || !isset($data['statut'])) {
    echo json_encode(['error' => 'Tous les champs sont requis']);
    exit;
}

$id = intval($data['id']);
$statut = htmlspecialchars(strip_tags($data['statut']));

$sql = "UPDATE commandes SET statut = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $statut, $id);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Statut de la commande mis à jour avec succès']);
} else {
    echo json_encode(['error' => 'Erreur lors de la mise à jour du statut de la commande']);
}

$stmt->close();
$conn->close();
?>
