<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file upload is successful
    if (isset($_FILES["myfile"]["error"])) {
        switch ($_FILES["myfile"]["error"]) {
            case UPLOAD_ERR_OK:
                // Upload successful
                $target_dir = "../sources/Courses/";
                $target_file = $target_dir . basename($_FILES["myfile"]["name"]);
                if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["myfile"]["name"]). " has been uploaded.";
                    echo "Uploaded file path: $target_file";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            default:
                echo "An error occurred while uploading the file.";
        }
    }
}

?>
