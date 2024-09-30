<?php

session_start();

require 'includes/db.php';

// form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validation (check if all fields are filled)
    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // fetch the user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // redirect to the homepage when logged in
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        <br>
        <form action="index.php" method="get">
            <button type="submit">Back to Home</button>
        </form>
    </div>
        
    <?php include 'includes/footer.php'; ?>
</body>
</html>
