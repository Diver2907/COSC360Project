<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$content = $data['content'];
$image_url = $data['image_url'];
if (!$user_id || !$content) {
    echo json_encode(["success" => false, "error" => "Missing user_id or content"]);
    exit;
}
$stmt = $conn->prepare("INSERT INTO posts (user_id, content, image_url) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $content, $image_url);
$success = $stmt->execute();
echo json_encode(["success" => $success]);
$stmt->close();
$conn->close();
?>