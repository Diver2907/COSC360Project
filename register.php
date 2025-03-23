<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$image = $data['image'];
$stmt = $conn->prepare("INSERT INTO users (username, email, password, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password, $image);
$result = $stmt->execute();
echo json_encode(["success" => $result]);
?>