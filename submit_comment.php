<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'];
$user_id = $data['user_id'];
$comment = $data['comment'];
$stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $post_id, $user_id, $comment);
$result = $stmt->execute();
echo json_encode(["success" => $result]);
?>