<?php
// Connect to the database (replace with your connection details)
require_once("../connection.php");

// Check if ID is provided in the URL parameter
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Prepare a query to fetch course details based on ID
  $sql = "SELECT * FROM newcourses WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  // Get the result from the prepared statement
  $result = $stmt->get_result();

  // Check if the record exists
  if ($result->num_rows == 1) {
    $record = $result->fetch_assoc();
    // echo json_encode($record); // Return record data as JSON
    // echo $record;
    return ($record);
  } else {
    echo "Error: Course with ID $id not found.";
  }
} else {
  echo "Error: Missing ID parameter.";
}

// Close the connection
$conn->close();
?>
