<?php
session_start();
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

// // Debugging
// echo "Post ID2: $post_id<br>";

// Fetch post details
try {
    $sql = "SELECT posts.title, posts.content, posts.created_at, users.username 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            WHERE posts.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        echo "Post not found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Database query failed: " . $e->getMessage();
    exit;
}

// Fetch comments for specific post
try {
    $comment_sql = "SELECT comments.content, comments.created_at, users.username 
                    FROM comments 
                    JOIN users ON comments.user_id = users.id 
                    WHERE comments.post_id = ? 
                    ORDER BY comments.created_at ASC";
    $comment_stmt = $pdo->prepare($comment_sql);
    $comment_stmt->execute([$post_id]);
    $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Failed to fetch comments: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><em>Posted on <?php echo htmlspecialchars($post['created_at']); ?> by <?php echo htmlspecialchars($post['username']); ?></em></p>
    <div>
        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>

    <h2>Comments</h2>

    <?php if ($comments): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><strong><?php echo htmlspecialchars($comment['username']); ?></strong> said:</p>
                <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                <p><em>Posted on <?php echo htmlspecialchars($comment['created_at']); ?></em></p>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php endif; ?>

    <!-- Comment form -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h3>Add a Comment</h3>
        <form action="add_comment.php" method="POST">
            <textarea name="content" rows="5" required></textarea><br>
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <button type="submit">Submit Comment</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Log in</a> to add a comment.</p>
    <?php endif; ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
