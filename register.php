<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// register.php
require 'db.php';

// Get the JSON input from the request body
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;
$bio = $data->bio;
$image = $data->image; // Base64-encoded image string (if provided)

// Securely hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the user data into the database
$stmt = $pdo->prepare("INSERT INTO users (username, password, bio, image) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$username, $hashedPassword, $bio, $image])) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
