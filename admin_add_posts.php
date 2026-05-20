<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

$uploader = $_SESSION['admin_username'];

// Connect to MySQL
$connection = mysqli_connect("","","",""); //your dataabse information

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve user input
$title = $_POST['title'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'uploads/'.$image;

// Use prepared statement to prevent SQL injection
$query = "INSERT INTO featured_posts (title, description, image, uploader_admin) VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $image, $uploader);

    if (mysqli_stmt_execute($stmt)) {
        move_uploaded_file($image_tmp_name, $image_folder);
        header("Location: admin_crud_posts.php");
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
