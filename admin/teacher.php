<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>


    <style>
        body {
            /* Add your styles for the body here */
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 25px;
        }

        .admin-nav-link {
            /* Add your styles for the <a> tags here */
            color: blue;
            text-decoration: none;
            margin-right: 10px;
            font-size: 35px;
            border: 0.5px solid black;
        }

        .admin-nav-link:hover {
            /* Add your styles for the <a> tags here */
            color: red;
        }

        #admincenter {
            text-align: center;
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="admincenter">
        <h1>
            Admin Dashboard and Navigation
        </h1>

        <nav>
            <a class="admin-nav-link" href="../index.php" class="nav-link">Preview</a>
            <a class="admin-nav-link" href="admin.php" class="nav-link">Course</a>
            <a class="admin-nav-link" href="index1.php" class="nav-link">Teacher</a>
            <a class="admin-nav-link" href="aboutUsManagement.php" class="nav-link">aboutUs</a>
            <a class="admin-nav-link" href="TeamManagement.php" class="nav-link">Team</a>
            <a class="admin-nav-link" href="OppurtunityManagement.php" class="nav-link">Oppurtunity</a>
            <a class="admin-nav-link" href="ContactManagement.php" class="nav-link">Contact</a>
        </nav>
    </div>

    <main>
        <?php include('index1.php') ?>

    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>

</html>