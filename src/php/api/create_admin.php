<?php
// src/php/api/create_user.php

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
$password = password_hash($data['password'], PASSWORD_BCRYPT);
$first_name = $data['first_name'];
$last_name = $data['last_name'];
$username = $first_name . ' ' . $last_name;

// Vérifier si l'email ou le nom d'utilisateur existe déjà
$check_sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email ou nom d'utilisateur déjà existant"]);
} else {
    $sql = "INSERT INTO users (username, email, password, created_at) VALUES ('$username', '$email', '$password', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Compte créé avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur: " . $sql . "<br>" . $conn->error]);
    }
}

$conn->close();
?>
