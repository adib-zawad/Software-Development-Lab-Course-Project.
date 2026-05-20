<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

$uploader = $_SESSION['admin_username'];



$connection = mysqli_connect("","","",""); //your dataabse information

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// -----------------creating a new user-----------------
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$email = $_POST['email'];

$image_name = $_FILES["image"]["name"];
$image_temp = $_FILES["image"]["tmp_name"];
$image_path = "uploads" . $image_name;


move_uploaded_file($image_temp, $image_path);

$query = "INSERT INTO users (username, password, email, profile_image) VALUES ('$username', '$password', '$email', '$image_path')";

if (mysqli_query($connection, $query)) {
    echo "New user added.";
    header("Location: admin_crud_users.html");

} else {
    echo "Error: " . mysqli_error($connection);
}




//---------------Displaying all users:------------------







mysqli_close($connection);


?>
