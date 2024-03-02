<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['courseId'];
    $userId = $_POST['userId'];
    echo "Course ID: $courseId";
    echo "User ID: $userId";

    require_once('connection.php'); // returns $conn
    $sql = "DELETE FROM user_cart
            WHERE user_id = $userId AND course_id = $courseId";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully Course ID: $courseId";

    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>