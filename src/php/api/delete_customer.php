<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

$client_id = $data['client_id'];

$sql = "DELETE FROM clients WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Client supprimé avec succès']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression du client']);
}

$stmt->close();
$conn->close();
?>
