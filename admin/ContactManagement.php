<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <?php include 'adminNavbar.php'; ?>
     <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="shortcut icon" href="./sources/logo.jpg" type="image/x-icon" />
</head>

<body>

    <main>
        
        <h3 class="text-center pt-5 text-secondary"><button style="background-color: blue; green: white; margin: 10px 20px; border: none; border-radius: 5px;">Edit</button></h3>
        
        <div class="container">
            <div class="row g-3 py-5">
                <div class="col">
                    <div class="box d-flex flex-column align-items-center text-center p-4">
                        <i class="fa-solid fa-phone text-secondary fs-4 p-4"></i>
                        <p class="fs-5 fw-semibold text-secondary">
                            096 5555 23 / 012 5555 23
                        </p>
                        <p class="fs-5 text-secondary lh-lg">
                            We're interested in working together! Contact now.
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="box d-flex flex-column align-items-center text-center p-5">
                        <i class="fa-solid fa-envelope fs-4 pb-4 text-secondary"></i>
                        <p class="fs-5 fw-semibold text-secondary">VGrow@gmail.com</p>
                        <p class="fs-5 text-secondary lh-lg">
                            Do you want to know about VGrow? Send a message.
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="box d-flex flex-column align-items-center text-center p-5">
                        <i class="fa-solid fa-location-dot fs-4 pb-4 text-secondary"></i>
                        <p class="fs-5 text-secondary lh-lg">
                            Floor 2, Room 207, Building A, RUPP, មហាវិថី
                            សហពន្ធ័រុស្ស៊ី(១១០), ភ្នំពេញ
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex flex-column align-items-center py-4 map">
            <h3 class="pb-5 text-center text-secondary">Address</h3>
            <div class="row">
                <div class="col">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.770586988356!2d104.88811507466836!3d11.56829714408951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109519fe4077d69%3A0x20138e822e434660!2z4Z6f4Z624Z6A4Z6b4Z6c4Z634Z6R4Z-S4Z6Z4Z624Z6b4Z-Q4Z6Z4Z6X4Z684Z6Y4Z634Z6T4Z-S4Z6R4Z6X4Z-S4Z6T4Z-G4Z6W4Z-B4Z6J!5e0!3m2!1skm!2skh!4v1702130218273!5m2!1skm!2skh"
                        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- Add your footer content here -->
    </footer>
</body>

</html>