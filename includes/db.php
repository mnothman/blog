<?php

$databasePath = __DIR__ . '/../data/blog_platform.db';

try {
    // create/connect to SQLite database
    $pdo = new PDO("sqlite:$databasePath");

    // set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // err message if fails
    echo "Connection failed: " . $e->getMessage();
    exit();
}
