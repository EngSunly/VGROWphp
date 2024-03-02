<?php
// Connect to the database (replace with your connection details)
require_once("../connection.php");

// Check if ID is provided in the URL parameter
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  echo $id;
  // Prepare a query to delete the course
  $sql = "DELETE FROM newcourses WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);


  if ($stmt->execute()) {
    echo "Course deleted successfully."; 
    // button that redirect to admin.php
    echo "<a href='admin.php'>Back to Admin</a>";
  } else {
    echo "Error deleting course: " . $conn->error;
  }


  $stmt->close();
  $conn->close();
    // Close the statement and connection
} else {
  echo "Error: Missing ID parameter.";
}
?>
