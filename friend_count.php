<?php
include 'db.php';

$user_id = $_GET['user_id'];

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM friends WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode(["count" => $result['count']]);
$stmt->close();
$conn->close();
?>
