<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>


    <style>
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
        #admincenter{
            text-align: center;
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="admincenter">
    <header>
        Admin Dashboard and Navigation
    </header>

    <nav>
        <a class="admin-nav-link" href="../index.php" class="nav-link">Preview</a>
        <a class="admin-nav-link" href="admin.php" class="nav-link">Course Management</a>
        <a class="admin-nav-link" href="admin.php" class="nav-link">Teacher Management</a>
    </nav>
    </div>
    
    <main>
        <?php include 'displaytable.php'; ?>
    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>

</html>

</style>
<a href="admin.php">Course Management</a>
<a href="admin.php">Teacher Management</a>
</nav>

<main>

    <?php include 'displaytable.php'; ?>

</main>


<footer>
    <!-- Add your footer content here -->
</footer>
</body>

</html>