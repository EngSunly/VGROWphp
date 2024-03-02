<?php

require_once("connection.php");

// Select data from the `courses` table (replace with your column names)
$sql = "SELECT * FROM newcourses";
$result = $conn->query($sql);
echo "<div id='coursesheader'>";
// Iterate through each row and output in the desired template
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status = $row['Status'];

        if ($status == 0) {
            continue;
        }

        echo "<div class='col'>";
        echo "<div class='card' style='width: 19rem'>";
        echo "<div class='card-img'>";
        echo "<img src='" . $row['image_path'] . "' class='card-img-top' alt='...' />"; // Adapt image path handling
        // echo $row['image_path']; // for debugging purposes
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<h6 class='card-title'>" . $row['title'] . "</h6>";
        echo "<p class='card-text'>" . $row['description'] . "</p>";
        echo "<p class='card-text'>";
        for ($i = 0; $i < $row['rating']; $i++) {
            echo "<i class='fa-solid fa-star'></i>";
        }
        echo "(<span>" . $row['rating'] . "</span>)</p>";
        echo "<div class='d-flex justify-content-between align-items-center'>";
        echo "<p class='card-price text-secondary m-0'>$" . $row['price'] . "</p>";
        $courseId = $row['id'];
     

        echo "<form id=additem$courseId>";
        if (isset($userId)) {
            echo "<input type='hidden' name='userid' value='" . $userId . "'>";
            echo "<input type='hidden' name='coursesid' value='" . $row['id'] . "'>";
        }

        if (isset($userId)) {
            echo "<button class='btn btn-outline-success rounded-pill' type='submit'>Add to cart</button>";
        } else {
            if (isset($userId)) {
                echo "<button class='btn btn-outline-success rounded-pill' type='submit'>Add to cart</button>";
            } else {
                echo "<button class='btn btn-outline-success rounded-pill' type='button' onclick='alert(\"Please Login in.\")'>Add to cart</button>";
            }

        }
        echo "</form>";







        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";





        echo "<script>
        const formaddcart$courseId = document.querySelector('#additem$courseId');
        formaddcart$courseId.addEventListener('submit', function(event) {
            event.preventDefault();
            const coursesid = formaddcart$courseId.querySelector('input[name=\"coursesid\"]').value;
            const userid = formaddcart$courseId.querySelector('input[name=\"userid\"]').value;
            const url = 'addtocart.php';
            const params = 'coursesid=' + coursesid + '&userid=' + userid;
            fetch(url, {
                method: 'POST',
                body: params,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
        location.reload();
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>";

    }
} else {
    echo "No courses found.";
}
echo "</div>";
// Close database connection
$conn->close();


?>