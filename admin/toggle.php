<?php
// Connect to the database (replace with your connection details)
require_once("../connection.php");

// Check if ID is provided in the URL parameter
if (isset($_POST['id'])) {
  $id = $_POST['id'];

  // Prepare a query to toggle the course status
  $sql = "UPDATE newcourses SET Status = NOT Status WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo "Course status toggled successfully.";
    // Button that redirects to admin.php
    echo "<a href='admin.php'>Back to Admin</a>";
  } else {
    echo "Error toggling status: " . $conn->error;
  }

  $stmt->close();
  $conn->close(); // Close the statement and connection
} else {
  echo "Error: Missing ID parameter.";
}
?>
