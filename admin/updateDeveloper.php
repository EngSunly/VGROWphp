<?php
require_once("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("update developer set Name = ?, Description = ? where id = ?");
    $stmt->bind_param("ssi", $name, $description, $Id);

    $Id = $_POST['Id'];
    $name = $_POST['Name'];
    $description = $_POST['Description'];

    $stmt->execute();
    $conn->close();

    header("Location: TeamManagement.php");
    exit();
}
