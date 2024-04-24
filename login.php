



<?php
// Connect to the database
require_once("connection.php");

// Get login credentials
// Get login credentials
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Validate username
if (empty($username)) {
  $errors[] = "Username is required.";
}

// Validate password
if (empty($password)) {
  $errors[] = "Password is required.";
}

// If no errors, attempt login
if (empty($errors)) {
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verify password using password_verify()
    if (password_verify($password, $row['password'])) {
      // Login successful
      session_start();
      $_SESSION['username'] = $row['username'];
      $_SESSION['userId'] = $row['id']; // Add user ID to session
      $_SESSION['isAdmin'] = $row['isAdmin']; // Check and store admin status
      if ($_SESSION['isAdmin'] == true) {
        header("Location: ./admin/admin.php");
        exit();
      }


      header("Location: index.php"); // Redirect to homepage or user dashboard
    } else {
      $errors[] = "Invalid username or password.";
    }
  } else {
    $errors[] = "Invalid username or password.";
  }
}

// Display errors if any
if (!empty($errors)) {
  echo "<h2>Errors:</h2>";
  foreach ($errors as $error) {
    echo "<p>$error</p>";
  }
  echo "<a href='login.html'>Go back</a>";
}

$conn->close();
?>