<?php
// get_user.php
require 'db.php';

$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("SELECT id, username, bio, image FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

echo json_encode($user);
?>
