<?php
// submit_post.php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id;
$content = $data->content;
$image_url = $data->image_url; // Base64 string or empty if no image

$stmt = $pdo->prepare("INSERT INTO posts (user_id, content, image_url, created_at) VALUES (?, ?, ?, NOW())");
$success = $stmt->execute([$user_id, $content, $image_url]);

echo json_encode(['success' => $success]);
?>
