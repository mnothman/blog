<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require 'includes/db.php'; // Ensure the database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to create a post.";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $user_id = $_SESSION['user_id']; // Get User ID from session

    // Prepare SQL statement to insert new post
    $sql = "INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, :created_at)";
    $stmt = $pdo->prepare($sql);
    
    $created_at = date('Y-m-d H:i:s');

    // Bind parameters to statement
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':created_at', $created_at);
    
    // Execute the query and check if successful
    if ($stmt->execute()) {
        echo "New post created successfully!";
    } else {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Create a New Post</h1>
    <form action="create_post.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="10" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
