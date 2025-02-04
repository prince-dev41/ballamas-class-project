<?php
// src/php/api/update_user.php

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

if (isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);

    $firstName = isset($data['firstName']) ? $data['firstName'] : '';
    $lastName = isset($data['lastName']) ? $data['lastName'] : '';
    $email = isset($data['email']) ? $data['email'] : '';
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : '';

    $sql = "UPDATE users SET username = CONCAT('$firstName', ' ', '$lastName'), email = '$email'";
    if (!empty($password)) {
        $sql .= ", password = '$password'";
    }
    $sql .= " WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Utilisateur mis à jour avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour de l'utilisateur: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ID de session non défini ou méthode de requête incorrecte"]);
}

$conn->close();
?>
