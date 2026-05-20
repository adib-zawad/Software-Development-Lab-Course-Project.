<?php
error_reporting(E_ERROR | E_PARSE);

// Connect to MySQL
$connection = mysqli_connect("","","",""); //your dataabse information

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $profile_image = $_FILES['profile_image']['name'];
    $image_size = $_FILES['profile_image']['size'];
    $image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $image_folder = 'uploads/' . $profile_image;

    // Check if the username already exists
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($connection, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        // Username already exists, display alert using JavaScript
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    } else {
        // Insert user data into the database
        $query = "INSERT INTO users (username, password, email, profile_image) VALUES ('$username', '$password', '$email', '$profile_image')";

        if (mysqli_query($connection, $query)) {
            move_uploaded_file($image_tmp_name, $image_folder);
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}

mysqli_close($connection);
?>
