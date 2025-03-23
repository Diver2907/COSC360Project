<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$friend_id = $data['friend_id'];
$action = $data['action']; // "add" or "remove"

if ($action === "add") {
    $stmt = $conn->prepare("INSERT IGNORE INTO friends (user_id, friend_id) VALUES (?, ?)");
} else if ($action === "remove") {
    $stmt = $conn->prepare("DELETE FROM friends WHERE user_id = ? AND friend_id = ?");
} else {
    echo json_encode(["success" => false, "error" => "Invalid action"]);
    exit;
}

$stmt->bind_param("ii", $user_id, $friend_id);
$success = $stmt->execute();

echo json_encode(["success" => $success]);
$stmt->close();
$conn->close();
?>
