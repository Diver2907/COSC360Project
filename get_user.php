<?php
include 'db.php';

$user_id = $_GET['user_id'];

$stmt = $conn->prepare("SELECT id, username, email, image, bio FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo json_encode($user);

$stmt->close();
$conn->close();
?>