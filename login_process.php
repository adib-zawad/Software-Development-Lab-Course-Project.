<?php
session_start();
$connection = mysqli_connect("","","",""); //your dataabse information
//database username sometime sby default is root 
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: posts_with_search.php"); // Redirect to a welcome page
    } else {
        header("Location: login.php");
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
    header("Location: login.php");
}

mysqli_close($connection);
?>
