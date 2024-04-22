<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <?php include 'adminNavbar.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="./sources/logo.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="../style.css" />

</head>

<body>

    <main>
        <h4 class="text-center pt-4 pb-2">Our Team Project</h4>
        <div class="container">
            <div class="row g-3 py-3">
                <?php
                require_once("../connection.php");

                $sql = "SELECT d.Id, d.Name, d.ImagePath, d.Description, p.PlatformName, sm.Url 
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
                                'Id' => $row['Id'],
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

                    $image_url = '../' . $source_dir . $developer['ImagePath'];
                    echo '<div class="col">
                    <div class="card d-flex justify-content-center align-items-center p-3" style="width: 18rem">
                    <div class="mb-3 ms-auto">
                        <button type="button" class="btn btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modal-' . $developer['Id'] . '">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-' . $developer['Id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="updateDeveloper.php">
                                        <div class="mb-3">
                                        <label for="Name" class="form-label">Id</label>
                                        <input type="text" class="form-control" name="Id" value="' . $developer['Id'] . '" readonly>
                                        </div>
                                        <div class="mb-3">
                                        <label for="Name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="Name" value="' . $developer['Name'] . '">
                                        </div>
                                        <div class="mb-3">
                                        <label for="Description" class="form-label">Description</label>
                                        <textarea class="form-control" name="Description" rows="3">' . $developer['Description'] . '</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
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
    <script src="https://kit.fontawesome.com/1f1308a9f0.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>