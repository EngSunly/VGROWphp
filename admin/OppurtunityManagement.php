<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <?php include 'adminNavbar.php'; ?>

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


    <main>
        <div class="container">
            <div class="jobs-list-container">
                <h2>5 Jobs</h2>

                <input class="job-search" type="text" placeholder="Search here..." />

                <div class="jobs"></div>
            </div>
        </div>
    </main>
    <script src="opportunity.js"></script>


    <footer>
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
    </footer>
</body>

</html>