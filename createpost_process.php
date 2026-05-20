<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

$uploader = $_SESSION['username'];


// Connect to MySQL
$connection = mysqli_connect("","","",""); //your dataabse information
//database username sometime sby default is root 
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
// Retrieve user input
$title = $_POST['title'];
$description = $_POST['post_description'];

$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'uploads/'.$image;


// Insert user data into the database
$query = "INSERT INTO posts (title, post_description, image, post_uploader) VALUES ('$title', '$description', '$image', '$uploader')";

if (mysqli_query($connection, $query)) {
    move_uploaded_file($image_tmp_name, $image_folder);
    echo "upload successful . <a href='welcome.php'>Back</a>";;
} else {
    echo "Error: " . mysqli_error($connection);
}
}
mysqli_close($connection);
?>
