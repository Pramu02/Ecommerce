<?php
require_once('conn/config.php');
$dbConnection = DatabaseConnection::getInstance(); // Create the instance
$conn = $dbConnection->getConnection(); // Get the connection
extract($_POST);

// Validate and sanitize user input
$name = mysqli_real_escape_string($conn, $name);
$price = mysqli_real_escape_string($conn, $price);
$desc = mysqli_real_escape_string($conn, $desc);

$uploaddir = 'news_images/';
$uploadfile = $uploaddir . basename($_FILES['attachment']['name']);

// Validate file type and size before moving it
if ($_FILES['attachment']['tmp_name'] && $_FILES['attachment']['size'] && getimagesize($_FILES['attachment']['tmp_name']) !== false) {
    move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
    $flname = "news_images/" . basename($_FILES["attachment"]["name"]);

    $query = "INSERT INTO product VALUES (NULL, '$name', '$price', '$flname', '$desc')";

    // Use prepared statement for security
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: add_product.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid file upload";
}
?>