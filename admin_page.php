<?php
session_start(); // Start the session (assuming you have session handling)

if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php'); // Redirect to the login page if the user is not logged in
    exit;
}

$username = $_SESSION['admin_username'];

$con = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admins WHERE admin_username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["admin_username"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
   
    <link rel="stylesheet" type="text/css" href="admin_page.css">
</head>
<body>

<header>
    <h1>DHAKA METRO GA</h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="posts_with_search.php">Posts</a>
        <a href="cars.php">CARS</a>
        <button><a href="logout.php">Logout</a></button>
    </nav>
</header>

<div class="wrapper">
    <div class="container">
        <p><strong> <?php echo 'Admin' ?></p> </strong>
        <a href="tadmin_display_users.php" class="btn" target="_blank">Manage Users</a>
        <br>
        <a href="tadmin_display_user_posts.php" class="btn" target="_blank">Manage user posts</a>

        <br>
        <a href="admin_crud_posts.php" class="btn" target="_blank">Add a featured post</a>
        <br>
        <a href="tadmin_display_featured_posts.php" class="btn" target="_blank">Manage featured Posts</a>
       
        <br>
        <a href="add_cars.php" class="btn" target="_blank">Add CARS</a>
        <br>
        <a href="admin_crud_cars.php" class="btn" target="_blank">Manage CARS</a>
    </div>

    <div class="cover"></div>
</div>

</body>
</html>
