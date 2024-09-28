<?php
require 'includes/db.php';

// Debugging
// echo "Post ID1: $post_id<br>";

// check 'id' is provided in the URL and is numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid post ID.";
    exit;
}

// post ID from URL 
$post_id = intval($_GET['id']);

// Debugging
echo "Post ID2: $post_id<br>";

try {
    // Prepare SQL statement to get the post
    $stmt = $pdo->prepare("SELECT title, content, created_at FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);

    // Fetch the post data
    $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($post); // Debugging: Output the post data

    // Assign variables from fetched data
    if (!empty($post)) {
        $title = $post[0]['title'];
        $content = $post[0]['content'];
        $created_at = $post[0]['created_at'];
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
