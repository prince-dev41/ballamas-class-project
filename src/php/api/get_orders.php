<?php
header('Content-Type: application/json');
include '../includes/db.php';

$sql = "SELECT c.id, c.client_id, cl.nom, cl.prenom, c.total, c.date_commande, c.statut
        FROM commandes c
        JOIN clients cl ON c.client_id = cl.id";
$result = $conn->query($sql);

$commandes = [];
while ($row = $result->fetch_assoc()) {
    $commandes[] = $row;
}

echo json_encode($commandes);

$conn->close();
?>
