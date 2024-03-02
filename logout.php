<?php
session_start();

// Destroy the session
session_destroy();

// Optionally redirect to the homepage or login page
header("Location: index.php"); // Or login.html if preferred

// Optionally display a success message (not always necessary)
// echo "You have been logged out.";
?>


