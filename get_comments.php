<?php
// get_comments.php
require 'db.php';

$post_id = $_GET['post_id'];

$stmt = $pdo->prepare("SELECT comments.*, users.username FROM comments 
                       JOIN users ON comments.user_id = users.id 
                       WHERE post_id = ? 
                       ORDER BY comments.created_at ASC");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll();

echo json_encode($comments);
?>
