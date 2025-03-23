<?php
include 'db.php';

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$bio = $_POST['bio'];
$imagePath = null;

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create folder if it doesn't exist
    }
    $filename = uniqid() . '_' . basename($_FILES['image']['name']);
    $targetPath = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        $imagePath = $targetPath;
    }
}

// Build the SQL query
if ($imagePath) {
    $stmt = $conn->prepare("UPDATE users SET username = ?, bio = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $bio, $imagePath, $user_id);
} else {
    $stmt = $conn->prepare("UPDATE users SET username = ?, bio = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $bio, $user_id);
}

$result = $stmt->execute();

echo json_encode(["success" => $result]);
?>
