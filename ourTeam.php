<!DOCTYPE html>
<html lang="en">

<head>
  <title>VGrow, Home page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="shortcut icon" href="./sources/logo.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
      <div class="container">
        <a class="navbar-brand" href="index.php">VGrow</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link py-4" href="ourTeam.php" style="color: #0866ff; border-bottom: 3px solid #0866ff">Our Team</a>
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
    <h4 class="text-center pt-4 pb-2">Our Team Project</h4>
    <div class="container">
      <div class="row g-3 py-3">
        <?php
        require_once("connection.php");

        $sql = "SELECT d.Name, d.ImagePath, d.Description, p.PlatformName, sm.Url 
        FROM developer d
        LEFT JOIN social_media sm ON d.Id = sm.DeveloperID
        LEFT JOIN platform p ON sm.PlatformId = p.Id";

        $result = $conn->query($sql);

        $developers = [];

        if ($result->num_rows > 0) {
          // Process each row
          while ($row = $result->fetch_assoc()) {
            // Create an associative array for each developer
            if (!isset($developers[$row['Name']])) {
              $developers[$row['Name']] = [
                'Name' => $row['Name'],
                'ImagePath' => $row['ImagePath'],
                'Description' => $row['Description'],
                'SocialMedia' => []
              ];
            }
            if (!empty($row['PlatformName']) && !empty($row['Url'])) {
              $developers[$row['Name']]['SocialMedia'][$row['PlatformName']] = $row['Url'];
            }
          }
        }

        $conn->close();

        $source_dir = "sources/";

        foreach ($developers as $developer) {
          $image_url = $source_dir . $developer['ImagePath'];
          echo '<div class="col">
            <div class="card d-flex justify-content-center align-items-center p-3" style="width: 18rem">
              <div class="team-card-pf">
                <img src="' . $image_url . '" class="card-img-top" alt="..." />
              </div>
              <div class="card-body team-card-body text-center">
                <h5 class="card-title">' . $developer['Name'] . '</h5>
                <p class="card-text">' . $developer['Description'] . '</p>
                <div class="d-flex justify-content-around">';

          foreach ($developer['SocialMedia'] as $platform => $url) {
            $iconColor = '';
            switch ($platform) {
              case 'facebook':
                $iconColor = '#0866ff';
                break;
              case 'telegram':
                $iconColor = '#28a7e8';
                break;
              case 'instagram':
                $iconColor = '#f60683';
                break;
              case 'linkedin':
                $iconColor = '#0073b2';
                break;
            }
            echo '<a target="_blank" href="' . $url . '">
                <i class="fa-brands fa-' . $platform . '" style="color: ' . $iconColor . '"></i>
              </a>';
          }

          echo '    </div>
              </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
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
          <a href="https://www.google.com/maps/place/%E1%9E%9F%E1%9E%B6%E1%9E%80%E1%9E%9B%E1%9E%9C%E1%9E%B7%E1%9E%91%E1%9F%92%E1%9E%99%E1%9E%B6%E1%9E%9B%E1%9F%90%E1%9E%99%E1%9E%97%E1%9E%BC%E1%9E%98%E1%9E%B7%E1%9E%93%E1%9F%92%E1%9E%91%E1%9E%97%E1%9F%92%E1%9E%93%E1%9F%86%E1%9E%96%E1%9F%81%E1%9E%89/@11.5787015,104.8812305,15z/data=!4m10!1m2!2m1!1srupp!3m6!1s0x3109519fe4077d69:0x20138e822e434660!8m2!3d11.5682919!4d104.89069!15sCgRydXBwkgEKdW5pdmVyc2l0eeABAA!16s%2Fm%2F0278m39?entry=ttu" target="_blank" class="nav-link"><i class="fa-solid fa-location-dot"></i> មហាវិថី សហពន្ធ័រុស្ស៊ី
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>