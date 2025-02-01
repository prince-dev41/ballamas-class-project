<?php
// src/php/api/fetch_emails.php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-vente";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT email FROM newletter";
$result = $conn->query($sql);

$emails = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $emails[] = $row['email'];
    }
}

echo json_encode(["success" => true, "emails" => $emails, "emails" => $emails ]);

$conn->close();
?>
