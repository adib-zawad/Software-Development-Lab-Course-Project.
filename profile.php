<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$con = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$select = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'") or die('query failed');
if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
<header>
        <h1>DHAKA METRO GA</h1>
        <nav>
            <a href="home.php" target="_blank">Home</a>
            <a href="welcome.php" target="_blank">Upload-Posts</a>
            <a href="posts_with_search.php" target="_blank">Posts</a>
            <a href="Profile.php" target="_blank">Profile</a>
            <button> <a href="logout.php">Logout</a>  </button>
           
  
        </nav>
    </header>
    <div class="container">
        <h2>User Profile</h2>
        <div>
        </div>
        <?php echo '<img src="uploads/'.$fetch['profile_image'].'" height="300" width="300">'; ?>

        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <!-- <label for="username">Username:</label> -->
                <!-- <input type="text" name="username" value="<?php echo $username; ?>" required> -->
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
               <input type="password" name="password" >
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" name="profile_image" accept="image/jpg, image/jpeg, image/png">
            </div>
            <input type="submit" value="Update Profile">
        </form>

    </div>
</body>
</html>
