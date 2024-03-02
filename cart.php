<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        .total-price {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        #removeitem {
            align: left;
            font-weight: bold;
        }

        #goback {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px;
            font-size: 50px;
            color: blue;
            /* Set the anchor color to blue */
            text-decoration: none;
            /* Remove underline */
            border: 1px solid black;
            /* Add border */
            padding: 10px;
            /* Add padding */
        }

        #goback:hover {
            color: red;
            /* Set the anchor highlight color to red on hover */
        }
    </style>

</head>

<body>

    </style>

    </head>

    <body>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST["userId"];
            echo " Hello User :$userId";
        }

        ?>

        <a id='goback' href="index.php">Go back to homepage</a>

        <?php
        require_once("connection.php");
        $sql = "SELECT `user_id`, `course_id` FROM `user_cart` WHERE user_id = $userId";
        // echo $sql;
        // Execute the SQL query and fetch the results
        $result = mysqli_query($conn, $sql);
        // Store course_id into an array
        $courseIds = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "<tr>";
            // echo "<td>" . $row['user_id'] . "</td>";
            // echo "<td>" . $row['course_id'] . "</td>";
            // echo "</tr>";
            $courseIds[] = $row['course_id'];

        }


        if (empty($courseIds)) {
            // Do something when $courseIds is empty
            echo "No courses found.";
        } else {




            // Query newcourses table using course_id
        
            $sql = "SELECT `id`, `title`, `price` FROM `newcourses` WHERE `id` IN (" . implode(",", $courseIds) . ")";
            $result = mysqli_query($conn, $sql);

            // Output the results in a table
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Price</th>";
            echo "<th>Remove</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            $totalprice = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['price'] . "$</td>";

                echo "<td>";

                // echo "<form action='delcart.php' method='post'>";
                // echo "<input type='hidden' name='courseId' value='" . $row['id'] . "'>";
                // echo "<input type='hidden' name='userId' value='" . $userId . "'>";
                // echo "<button type='submit'>Remove this Course</button>";
                // echo "</form>";
                $courseId = $row['id'];

                echo "<form id='removeitem$courseId'>";
                echo "<input type='hidden' name='courseId' value='" . $row['id'] . "'>";
                echo "<input type='hidden' name='userId' value='" . $userId . "'>";
                echo "<button type='submit'>Remove This Course</button>";
                echo "</form>";


                echo "<script>
    const form$courseId = document.querySelector('#removeitem$courseId');
    form$courseId.addEventListener('submit', function(event) {
        event.preventDefault();
        const courseId = form$courseId.querySelector('input[name=\"courseId\"]').value;
        const userId = form$courseId.querySelector('input[name=\"userId\"]').value;
        const url = 'delcart.php';
        const params = 'courseId=' + courseId + '&userId=' + userId;
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



                echo "</td>";
                echo "</tr>";
                $totalprice += $row['price'];
            }

            echo "</tbody>";
            echo "</table>";
            echo "<div style='text-align: center;'>";
            echo "<h3>Total Price: " . $totalprice . "$</h3>";
            echo "</div>";

        }
        $conn->close();
        ?>
        </tbody>
        </table>

    </body>

</html>


</body>

</html>