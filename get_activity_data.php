<?php
include 'db.php';

header('Content-Type: application/json');

$stmt = $conn->prepare("
    SELECT DATE(created_at) as day, COUNT(*) as count
    FROM posts
    GROUP BY day
    ORDER BY day DESC
    LIMIT 7
");
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
