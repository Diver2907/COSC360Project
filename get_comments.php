<?php
include 'db.php';
$post_id = $_GET['post_id'];
$stmt = $conn->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at ASC");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}
echo json_encode($comments);
?>