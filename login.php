<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// login.php
require 'db.php';

// Get the JSON input from the request body
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

// Query to fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(["success" => true, "user_id" => $user['id']]);
} else {
    echo json_encode(["success" => false]);
}
?>