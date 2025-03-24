<?php
// friend_count.php
require 'db.php';

$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM friends WHERE user_id = ?");
$stmt->execute([$user_id]);
$data = $stmt->fetch();

echo json_encode(['count' => $data['count']]);
?>
