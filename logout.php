<?php

session_start();

// destroy the session
session_destroy();

// redirect to the homepage
header("Location: index.php");
exit();
