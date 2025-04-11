<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data || !isset($data['username']) || !isset($data['password']) || !isset($data['name'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    $username = $data['username'];
    $name = $data['name']; // full name, optional depending on your DB
    $email = isset($data['email']) ? $data['email'] : ""; // email fallback
    $password = $data['password'];
    $bio = isset($data['bio']) ? $data['bio'] : '';
    $image = isset($data['image']) ? $data['image'] : '';
    $is_admin = isset($data['is_admin']) ? (int)$data['is_admin'] : 0;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require 'db.php';

    $stmt = $conn->prepare("INSERT INTO users (username, password, bio, image, email, name, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $username, $hashedPassword, $bio, $image, $email, $name, $is_admin);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Could not register user']);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
