<style>
    header {
        font-size: 50px;
    }

    #uploadC {
        display: flex;
        justify-content: center;
        font-size: 20px;
        border: 2px solid black;
        padding: 10px;
        margin: 10px;
        text-decoration: none;
        color: black;

    }


    /* Overall table styling */
    table {
        width: 100%;
        /* Adjust if desired */
        font-family: sans-serif;
        /* Choose a suitable font */
        background-color: #f8f9fa;
        /* Light background */
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Table header styling */
    th {
        background-color: #dee2e6;
        /* Subtle header background */
        color: #495057;
        /* Darker text color */
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        text-align: center;
    }

    /* Table data styling */
    td {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        text-align: left;
        vertical-align: middle;
    }

    /* Add a hover effect to rows */
    tr:hover {
        background-color: #e9ecef;
    }

    img {
        width: 100%;
        height: auto;
        /* Maintain aspect ratio */
        max-width: 150px;
        /* Adjust image size as needed */
    }

    /* Style buttons */
    button {
        background-color: #4CAF50;
        /* Green color */
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin: 5px;
    }

    button:hover {
        background-color: #45a049;
        /* Darker green on hover */
    }

    #landingCoursesIntro {
        font-size: 50px;
        text-align: center;
        margin: 10px;


    }
</style>
<div id="landingCoursesIntro"> Welcome to Course Management </div>
<div>
    <a id="uploadC" href="upload.html">Add Course</a>

</div>



<?php
require_once("../connection.php");

$sql = "SELECT * FROM newcourses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>ID</th><th>Title</th><th>Description</th><th>Rating</th><th>Price</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";

        // Round the rating and output with one decimal place
        $rounded_rating = round($row['rating'], 1);
        echo "<td>" . $rounded_rating . "</td>";

        echo "<td>$" . $row['price'] . "</td>";
        echo "</tr>";

        // Add the image row after the course details
        echo "<tr><td colspan='4'><img src='../" . $row['image_path'] . "' class='img-fluid' alt='" . $row['image_path'] . "' />";

        $id = $row['id'];
        echo "<form action='editDB.php' method='get'>";
        echo "<button type='submit' name='id' value='$id'>Update</button>";
        echo "</form>";

        echo "<form action='deleteDB.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this course?\")'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<button type='submit'>Delete</button></form>";


        echo "<form action='toggle.php' method='post'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<button id='toggleButton' type='submit'>Toggle Status: " . (($row['Status']) ? "Active" : "Inactive") . "</button>";
        echo "</form>";


        echo "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No courses found.";
}

$conn->close();
?>