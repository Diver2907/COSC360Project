<?php
include 'db.php';
$action = $_GET['action'];
$id = $_GET['id'];
switch ($action) {
    case 'disable_user':
        $stmt = $conn->prepare("UPDATE users SET disabled = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;
    case 'enable_user':
        $stmt = $conn->prepare("UPDATE users SET disabled = 0 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;
    case 'delete_post':
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;
    case 'disable_post':
        $stmt = $conn->prepare("UPDATE posts SET disabled = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["success" => true]);
        break;
}
?>