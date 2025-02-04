<?php
header('Content-Type: application/json');
include '../includes/db.php';

$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

$commandes = [];
while ($row = $result->fetch_assoc()) {
    $clients[] = $row;
}

echo json_encode($clients);

$conn->close();
?>
