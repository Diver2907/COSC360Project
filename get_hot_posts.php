<?php
include 'db.php';
$sql = "
    SELECT posts.*, users.username, COUNT(comments.id) AS comment_count
    FROM posts
    JOIN users ON posts.user_id = users.id
    LEFT JOIN comments ON posts.id = comments.post_id
    GROUP BY posts.id
    ORDER BY comment_count DESC
    LIMIT 5
";
$result = $conn->query($sql);
$hot_posts = [];
while ($row = $result->fetch_assoc()) {
    $hot_posts[] = $row;
}
echo json_encode($hot_posts);
?>
