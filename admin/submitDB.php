<?php

// Include connection details (ensure secure handling)
require_once("../connection.php");

// Sanitize and validate form data (important for security)
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$filepath = filter_input(INPUT_POST, 'filepath', FILTER_SANITIZE_STRING);

// Validate required fields
if (empty($title) || empty($description) || empty($rating) || empty($price) || empty($filepath)) {
    $missingFields = [];
    if (empty($title)) {
        $missingFields[] = "title";
    }
    if (empty($description)) {
        $missingFields[] = "description";
    }
    if (empty($rating)) {
        $missingFields[] = "rating";
    }
    if (empty($price)) {
        $missingFields[] = "price";
    }
    if (empty($filepath)) {
        $missingFields[] = "filepath";
    }
    
    echo "Please fill in all required fields: " . implode(", ", $missingFields);
    exit;
}

// Construct the SQL query (parameterized placeholder to prevent SQL injection)
$sql = "INSERT INTO `newcourses`(`title`, `description`, `rating`, `image_path`, `price`, `Status`) VALUES (?, ?, ?, ?, ?,1)";

// Prepare the statement using mysqli_stmt
$stmt = mysqli_prepare($conn, $sql);

// Bind values to the statement (avoid hardcoded values)
mysqli_stmt_bind_param($stmt, "sssss", $title, $description, $rating, $filepath, $price);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {

    echo "Course added successfully!";
    
    // Redirect to the admin page
    header("Location: admin.php");

} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and connection (important)
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
