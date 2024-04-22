<!DOCTYPE html>
<html lang="en">

<head>
    <title>VGrow, Home page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="./sources/logo.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
            <div class="container">
                <a class="navbar-brand" href="index.php">VGrow</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-3 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link py-4" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-4" href="course.php">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-4" href="aboutUs.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-4" href="ourTeam.php">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-4" href="Oppurtunity.php">Oppurtunity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-4" href="contactUs.php">Contact Us</a>
                        </li>
                    </ul>
                    <div>
                        <?php
                        session_start();
                        if (isset($_SESSION['username'])) {
                            echo "Welcome, " . $_SESSION['username'];
                            echo " ";
                            $userId = $_SESSION['userId'];
                            // echo $userId ;
                            echo "<br>"; // Add line break for spacing
                            $isAdmin = $_SESSION['isAdmin'];
                            // echo $isAdmin;
                            if ($isAdmin == true) {

                                echo "<a href='admin\admin.php'>Admin Page";
                                echo "<a/>";
                            }
                            ?>
                            <a href="logout.php">Logout</a>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                <button type="submit">My Cart</button>
                            </form>


                            <!-- <a href="cart.php">My Cart</a> try session to find out about session later -->

                            <?php

                        } else {
                            ?>
                            <a href="login.html">Login</a>
                            <div>or</div>
                            <a href="createUserForm.html">Sign UP!</a>
                            <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <body>


            </head>

            <body>

                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $userId = $_POST["userId"];
                    // echo " Hello User :$userId";
                } else {
                    echo "No user found";
                    echo `<a id='goback' href="index.php">Go back to homepage</a>`;
                }

                ?>

                <br>
              

                <?php
                require_once ("connection.php");

                $usernamesql = "SELECT `username` FROM `users` WHERE id = $userId";

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
                    echo "<button style='margin-bottom: 50px;'>Make Payment</button>";
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

                #goback {
                    display: block;
                    margin: 20px 0;
                    text-align: center;
                }

                a:hover {
                    text-decoration: underline;
                }
            </style>


    </main>

    <footer>
        <div class="r5">
            <div class="r5-r1">
                <div class="r5-r1-c1">
                    <h6 class="text-white">VGrow</h6>
                </div>
                <div class="r5-r1-c2">
                    <h5>Languages</h5>
                    <a href="#" class="nav-link">HTML</a>
                    <a href="#" class="nav-link">CSS</a>
                    <a href="#" class="nav-link">JavaScript</a>
                    <a href="#" class="nav-link">Java</a>
                    <a href="#" class="nav-link">Python</a>
                    <a href="#" class="nav-link">PHP</a>
                </div>
                <div class="r5-r1-c3">
                    <h5>Support</h5>
                    <a href="#" class="nav-link">Privacy Policy</a>
                    <a href="#" class="nav-link">Terms & Conditions</a>
                    <a href="#" class="nav-link">Support</a>
                    <a href="#" class="nav-link">FAQ</a>
                </div>
                <div class="r5-r1-c4">
                    <h5>Contact Us</h5>
                    <a href="#" class="nav-link"><i class="fa-solid fa-phone"></i> 023 5555 23</a>
                    <a href="#" class="nav-link"><i class="fa-solid fa-envelope"></i> VGrow@gmail.com</a>
                    <a href="https://www.google.com/maps/place/%E1%9E%9F%E1%9E%B6%E1%9E%80%E1%9E%9B%E1%9E%9C%E1%9E%B7%E1%9E%91%E1%9F%92%E1%9E%99%E1%9E%B6%E1%9E%9B%E1%9F%90%E1%9E%99%E1%9E%97%E1%9E%BC%E1%9E%98%E1%9E%B7%E1%9E%93%E1%9F%92%E1%9E%91%E1%9E%97%E1%9F%92%E1%9E%93%E1%9F%86%E1%9E%96%E1%9F%81%E1%9E%89/@11.5787015,104.8812305,15z/data=!4m10!1m2!2m1!1srupp!3m6!1s0x3109519fe4077d69:0x20138e822e434660!8m2!3d11.5682919!4d104.89069!15sCgRydXBwkgEKdW5pdmVyc2l0eeABAA!16s%2Fm%2F0278m39?entry=ttu"
                        target="_blank" class="nav-link"><i class="fa-solid fa-location-dot"></i> មហាវិថី សហពន្ធ័រុស្ស៊ី
                        (១១០), ភ្នំពេញ</a>
                </div>
            </div>
            <div class="r5-r2">
                <div class="container">
                    <p>
                        <i class="fa-solid fa-copyright"></i> 2023. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="index.js"></script>

    <!-- Font Awesome  -->
    <script src="https://kit.fontawesome.com/1f1308a9f0.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>