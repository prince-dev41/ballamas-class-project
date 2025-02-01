<?php
// src/php/api/login.php

session_start();
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
$password = $data['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(["success" => true, "message" => "Connexion réussie"]);
    } else {
        echo json_encode(["success" => false, "message" => "Mot de passe incorrect"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Email non trouvé"]);
}

$conn->close();
?>
