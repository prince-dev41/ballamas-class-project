<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    echo json_encode(['error' => 'ID de la commande requis']);
    exit;
}

$id = intval($data['id']);

$sql = "DELETE FROM commandes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Commande supprimée avec succès']);
} else {
    echo json_encode(['error' => 'Erreur lors de la suppression de la commande']);
}

$stmt->close();
$conn->close();
?>
