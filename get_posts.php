<?php
include 'db.php';
$result = $conn->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.disabled = 0 ORDER BY created_at DESC");
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
echo json_encode($posts);
?>