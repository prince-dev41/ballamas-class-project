<?php
header('Content-Type: application/json');
include '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$nom = $data['nom'];
$prenom = $data['prenom'];
$adresse = $data['adresse'];
$email = $data['email'];
$telephone = $data['telephone'];

$sql = "INSERT INTO clients (nom, prenom, adresse, email, telephone) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nom, $prenom, $adresse, $email, $telephone);

if ($stmt->execute()) {
    $client_id = $stmt->insert_id;
    echo json_encode(['client_id' => $client_id]);
} else {
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement du client']);
}

$stmt->close();
$conn->close();
?>
