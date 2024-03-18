<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>

</head>

<body>
    

    </head>

    <body>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_POST["userId"];
            // echo " Hello User :$userId";
        }else {
            echo "No user found";
            echo  `<a id='goback' href="index.php">Go back to homepage</a>`;
        }

        ?>

        <br>
        <a id='goback' href="index.php">Go back to homepage</a>

        <?php
        require_once("connection.php");

        $usernamesql ="SELECT `username` FROM `users` WHERE id = $userId";
        
        $usernameresult = mysqli_query($conn, $usernamesql);
        $username = mysqli_fetch_assoc($usernameresult);
        echo "<h1> Hello $username[username] Here are the Item in your Carts</h1>";





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
            echo "<button>Make Payment</button>";
            echo "</div>";

        }
        $conn->close();
        ?>
        </tbody>
        </table>

    </body>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            
            color: #007bff;
            text-decoration: none;
        }
        #goback{
            display: block;
            margin: 20px 0;
            text-align: center;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</html>

