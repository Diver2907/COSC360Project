<?php
// get_posts.php
require 'db.php';

$stmt = $pdo->query("SELECT posts.*, users.username FROM posts 
                     JOIN users ON posts.user_id = users.id
                     ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();

echo json_encode($posts);
?>
