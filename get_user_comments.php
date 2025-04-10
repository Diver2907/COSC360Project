<?php
include 'db.php';

header('Content-Type: application/json');

if (isset($_GET['post_id'])) {
    // Get all comments for a specific post with usernames
    $post_id = $_GET['post_id'];
    $stmt = $conn->prepare("
        SELECT c.comment, u.username 
        FROM comments c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.post_id = ?
        ORDER BY c.created_at DESC
    ");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    echo json_encode($comments);
} elseif (isset($_GET['user_id'])) {
    // Get all comments made by a specific user
    $user_id = $_GET['user_id'];
    $stmt = $conn->prepare("SELECT post_id, comment FROM comments WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    echo json_encode($comments);
} else {
    echo json_encode(["error" => "Missing post_id or user_id"]);
}
?>
