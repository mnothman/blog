<?php
session_start();
require 'includes/db.php'; 

// Check user logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a comment.";
    exit;
}

// Check if form is submitted and post_id set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    // form data
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id']; // User ID from session
    $content = htmlspecialchars($_POST['content']);

    // Insert comment into the database
    try {
        $sql = "INSERT INTO comments (post_id, user_id, content, created_at) VALUES (:post_id, :user_id, :content, :created_at)";
        $stmt = $pdo->prepare($sql);
        $created_at = date('Y-m-d H:i:s');
        
        // Bind parameters
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':created_at', $created_at);

        if ($stmt->execute()) {
            // Redirect back to the post page after adding the comment goes through
            header("Location: view_post.php?id=$post_id");
            exit();
        } else {
            echo "Error: " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Failed to add comment: " . $e->getMessage();
    }
}
?>
