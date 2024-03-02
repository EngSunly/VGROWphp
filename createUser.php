<?php
// Connect to the database
require_once("connection.php");

// Validate form data
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

$errors = [];

if (empty($username)) {
  $errors[] = "Username is required.";
}
if (empty($email)) {
  $errors[] = "Email is required.";
}
if (empty($password)) {
  $errors[] = "Password is required.";
}
if ($password !== $confirm_password) {
  $errors[] = "Passwords do not match.";
}

// Check for existing user
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $errors[] = "Username or email already exists.";
}

// Create user if no errors
if (empty($errors)) {
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

  if ($conn->query($sql) === TRUE) {
    header("Location: login.html"); // Redirect to success page
  } else {
    echo "Error: " . $conn->error;
  }
} else {
  // Display errors
  echo "<h2>Errors:</h2>";
  foreach ($errors as $error) {
    echo "<p>$error</p>";
  }
  echo "<a href='index.php'>Go back</a>";
}

$conn->close();
?>