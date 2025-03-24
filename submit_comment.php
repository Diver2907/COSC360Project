<?php
// submit_comment.php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$post_id = $data->post_id;
$user_id = $data->user_id;
$comment = $data->comment;

$stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
$success = $stmt->execute([$post_id, $user_id, $comment]);

echo json_encode(['success' => $success]);
?>
