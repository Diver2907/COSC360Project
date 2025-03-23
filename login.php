<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
if ($result && password_verify($password, $result['password'])) {
    echo json_encode(["success" => true, "user_id" => $result['id']]);
} else {
    echo json_encode(["success" => false]);
}
?>