<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

$client_id = $data['client_id'];
$total = $data['total'];

$sql = "INSERT INTO commandes (client_id, total) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $client_id, $total);

if ($stmt->execute()) {
    $commande_id = $stmt->insert_id;
    echo json_encode(['commande_id' => $commande_id]);
} else {
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement de la commande']);
}

$stmt->close();
$conn->close();
?>
