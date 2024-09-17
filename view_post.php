<?php
require 'includes/db.php'; // Ensure the database connection is included

// Debugging: Output the post_id and check if it's valid
echo "Post ID: $post_id<br>";

// Check if 'id' is provided in the URL and is numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid post ID.";
    exit;
}

// Get the post ID from URL
$post_id = intval($_GET['id']);

try {
    // Prepare SQL statement to get the post
    $stmt = $pdo->prepare("SELECT title, content, created_at FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);

    if ($stmt->rowCount() > 0) {
        $post = $stmt->fetch();
        $title = $post['title'];
        $content = $post['content'];
        $created_at = $post['created_at'];
    } else {
        echo "Post not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Database query failed: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($title); ?></h1>
    <p><em>Posted on <?php echo htmlspecialchars($created_at); ?></em></p>
    <div>
        <?php echo nl2br(htmlspecialchars($content)); ?>
    </div>
    <a href="index.php">Back to Home</a>
</body>
</html>
