<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $userId = $_POST['userid'];
    $coursesId = $_POST['coursesid'];

    // Perform the necessary actions with the values
    // For example, you can echo the values like this:
    // echo "User ID: " . $userId . "<br>";
    // echo "Courses ID: " . $coursesId . "<br>";

    require_once("connection.php");// will return $conn

    function checkDuplicate($userId, $coursesId, $conn)
    {
        $query = "SELECT COUNT(*) FROM user_cart WHERE user_id = '$userId' AND course_id = '$coursesId'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_fetch_row($result)[0];

        if ($count > 0) {
            return true; // Duplicate value exists
        } else {
            return false; // No duplicate value exists
        }
    }

    function addToCart($userId, $coursesId, $conn)
    {
        $query = "INSERT INTO user_cart (user_id, course_id) VALUES ('$userId', '$coursesId')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Course added to cart successfully! $coursesId";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    if (checkDuplicate($userId,$coursesId, $conn)) {
        echo "Course already exists in cart";
    } else {
        addToCart($userId, $coursesId, $conn);
    }
}
?>
