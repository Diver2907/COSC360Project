<?php
include 'db.php';

$user_id = $_GET['user_id'];

$stmt = $conn->prepare("
    SELECT u.id, u.username, u.image
    FROM friends f
    JOIN users u ON u.id = f.friend_id
    WHERE f.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$friends = [];
while ($row = $result->fetch_assoc()) {
    $friends[] = $row;
}

echo json_encode($friends);
$stmt->close();
$conn->close();
?>
