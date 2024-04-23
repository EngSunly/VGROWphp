<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>File Upload with Options (Update)</title>
  <style>
    form {
      display: block;
      width: 80%;
      /* Makes the form itself a block element */
    }

    .form-group {
      display: flex;
      /* Wraps each group in a flex container */
      flex-direction: column;
      /* Stacks elements vertically */
      margin-bottom: 10px;
      /* Adds some space between groups */
    }

    label {
      margin-bottom: 5px;
      /* Adjusts label spacing */
    }

    textarea,
    input {
      width: 100%;
      /* Makes elements fill the available space */
      padding: 5px;
      /* Adds some padding for better styling */
      border: 1px solid #ccc;
      /* Basic border for visual definition */
    }

    button {
      /* Style your button as desired */
      background-color: #4CAF50;
      /* Example green color */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
  <?php include 'adminNavbar.php'; ?>
</head>

<body>
  <?php
  // Get ID from URL parameter (assume 'id' as parameter name)
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch record details from data.php
    $record = include 'data.php'; // Assuming data.php returns retrieved data
    // Output record details
    echo "<h2>Orignal Record Details</h2> <h2>";
    echo "ID: " . $record['id'] . "<br>";
    echo "Title: " . $record['title'] . "<br>";
    echo "Description: " . $record['description'] . "<br>";
    echo "Rating: " . $record['rating'] . "<br>";
    echo "Price: " . $record['price'] . "<br>";
    echo "Filepath: " . $record['image_path'] . "<br>";
    echo "</h2>";
  } else {
    echo "Error: Invalid record ID.";
    exit; // Stop execution if no ID found
  }
  ?>

  <form id="upload-form" method="post" enctype="multipart/form-data">
    <input type="file" name="myfile" id="myFile">
    <script>
      const fileInput = document.getElementById('myFile');
      const fileInfoDiv = document.getElementById('fileInfo');
      fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const fileNameParts = file.name.split(/\s+/); // Split by whitespace

        // Check if more than one word
        if (fileNameParts.length > 1) {
          event.preventDefault(); // Prevent form submission
          alert('The file name must be a single word.');
        }
        else {
          const fileInfoDiv = document.getElementById('fileInfo');
          fileInfoDiv.textContent = `Filename: ${file.name}`;
          fileInfoDiv.textContent += `\nFile size: ${file.size / 1024} KB`;
        }
      });
    </script>

    <div id="fileInfo"></div>
    <!-- <script>
            const fileInput = document.getElementById('myFile');
            const fileInfoDiv = document.getElementById('fileInfo');

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0]; // Get the first selected file

                if (file) {
                    fileInfoDiv.textContent = `Filename: ${file.name}`;
                    fileInfoDiv.textContent += `\nFile size: ${file.size / 1024} KB`;
                } else {
                    fileInfoDiv.textContent = 'Please select a file.';
                }
            });
        </script> -->

    <div id="upload-response"></div>
    <script>
      const form = document.getElementById('upload-form');
      const responseContainer = document.getElementById('upload-response');
      form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent default form submission
        const formData = new FormData(form);
        fetch('upload.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.text())
          .then(data => {
            responseContainer.textContent = data; // Display the response from upload.php
            const filePath = data.split("Uploaded file path: ")[1];
            responseContainer.innerHTML += "<br>" + filePath + "<br>" + "<img src=./" + filePath + " alt='Uploaded Image' style='width: 100px; height: 100px;'/>";
            // auto fill the filepath input
            document.getElementById('filepath').value = filePath.split("../")[1];
            // document.getElementById('filepath').innerHTML = filePath.split("../")[1];

 
          })
          .catch(error => {
            console.error('Error:', error);
            responseContainer.textContent = 'An error occurred during upload.';
          });
      });
    </script>
    <label>Upload new image if you wished to change image and press upload button to update the image path</label><br>
    <button type="submit">Upload</button>
  </form>
  <form id="detailform" action="submitUpdateDB.php" method="post">
    <div class="form-group">
      <label for="title">Title:</label>
      <textarea id="title" name="title"><?php echo $record['title']; ?></textarea>
    </div>

    <div class="form-group">
      <label for="description">Description:</label>
      <textarea id="description" name="description"><?php echo $record['description']; ?></textarea>
    </div>

    <div class="form-group">
      <label for="rating">Rating (decimal):</label>
      <input type="number" step="0.1" id="rating" name="rating" min="0" max="5"
        value="<?php echo $record['rating']; ?>">
    </div>

    <div class="form-group">
      <label for="price">Price (decimal):</label>
      <input type="number" step="0.01" id="price" name="price" min="0" value="<?php echo $record['price']; ?>">
    </div>

    <div class="form-group">
      <label for="filepath">Filepath:</label>
      <input type="text" id="filepath" name="filepath" value="<?php echo $record['image_path']; ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit">Update</button>
  </form>

</body>

</html>