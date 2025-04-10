<?php
include 'db.php';

header('Content-Type: application/json');

session_start();

// Optional: If you want to use session check instead of localStorage
// if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
//     echo json_encode(["error" => "Unauthorized"]);
//     exit;
//}

$q = isset($_GET['q']) ? '%' . strtolower($_GET['q']) . '%' : '%';

$users = [];
$posts = [];

// Search users by username or email
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE username LIKE ? OR email LIKE ?");
$stmt->bind_param("ss", $q, $q);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();

// Search posts by content, joined with usernames
$stmt = $conn->prepare("
    SELECT posts.content, posts.image_url, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.content LIKE ?
");
$stmt->bind_param("s", $q);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
$stmt->close();

echo json_encode([
    "users" => $users,
    "posts" => $posts
]);
?>
