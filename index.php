<?php

session_start();


// require 'vendor/autoload.php';
require 'includes/db.php';
require 'includes/functions.php';

// Debugging
// echo "Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "No user logged in") . "<br>";
// echo "Session username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : "No username") . "<br>";


// fetch all the posts from db
$sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, users.username 
        FROM posts 
        LEFT JOIN users ON posts.user_id = users.id 
        ORDER BY posts.created_at DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Blog</h1>

        <?php if (isset($_SESSION['username'])): ?>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>! <a href="logout.php">Logout</a></p>
            <a href="create_post.php">Create New Post</a>
        <?php else: ?>
            <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to start posting!</p>
        <?php endif; ?>

        <hr>

        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2>
                        <a href="view_post.php?id=<?php echo $post['id']; ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </h2>
                    <p class="meta">by <?php echo htmlspecialchars($post['username'] ?? 'Unknown User'); ?> on
                        <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars(substr($post['content'], 0, 200))); ?>...</p>
                    <a href="view_post.php?id=<?php echo $post['id']; ?>">Read more</a>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts have been published yet.</p>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>