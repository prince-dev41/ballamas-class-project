<?php
// src/php/api/subscribe.php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-vente";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];

$sql = "INSERT INTO newletter (email) VALUES ('$email')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Inscription réussie"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
