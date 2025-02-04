<?php
header('Content-Type: application/json');
include '../includes/db.php'; // Inclure le fichier de connexion à la base de données

$data = json_decode(file_get_contents('php://input'), true);

$client_id = $data['client_id'];
$nom = $data['nom'];
$email = $data['email'];
$telephone = $data['telephone'];
$adresse = $data['adresse'];

$sql = "UPDATE clients SET nom=?, email=?, telephone=?, adresse=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nom, $email, $telephone, $adresse, $client_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Client mis à jour avec succès']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du client']);
}

$stmt->close();
$conn->close();
?>
