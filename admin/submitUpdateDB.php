<?php
// Connect to the database (replace with your connection details)
require_once("../connection.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get values from the form
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $rating = $_POST['rating'];
  $price = $_POST['price'];
  $image_path = $_POST['filepath'];
   
  // Prepare the update query
  $sql = "UPDATE newcourses SET 
          title = ?, 
          description = ?, 
          rating = ?, 
          price = ?, 
          image_path = ? 
          WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi", $title, $description, $rating, $price, $image_path, $id);


  // Execute the query
  if ($stmt->execute()) {
    echo "Course updated successfully.";
     // button that redirect to admin.php
     echo "<a href='admin.php'>Back to Admin</a>";
  } else {
     // button that redirect to admin.php
     echo "<a href='admin.php'>Back to Admin</a>";
    echo "Error updating course: " . $conn->error;
  }

  
  // Close the statement and connection
  $stmt->close();
  $conn->close();
} else {
  echo "Invalid request method.";
}
?>
