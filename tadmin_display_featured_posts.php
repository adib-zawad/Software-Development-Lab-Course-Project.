<?php
$connection = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete button is clicked
if (isset($_POST['delete_post'])) {
    $post_id_to_delete = $_POST['post_id'];

    // Use prepared statement to prevent SQL injection
    $sql_delete = "DELETE FROM featured_posts WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $post_id_to_delete);
    $stmt_delete->execute();

    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

$sql = "SELECT * FROM featured_posts ORDER BY id DESC"; // Retrieve all posts in order of their IDs
$result = $conn->query($sql);

$posts = array(); // An array to store post data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="tposts.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="tadmin_display_featured_post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <h1>PhoneField</h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="posts.php">Posts</a>
        <a href="admin_login.php">Admin</a>
        <a href="login.php">Signin</a>
        <a href="register.php">Register</a>
    </nav>
</header>

<h2>Posts</h2>

<div class="post-container">
    <?php foreach ($posts as $post) { ?>
        <div class="post">
            <div class="uploader"><?php echo $post["uploader_admin"]; ?></div>
            <div class="title"><?php echo $post["title"]; ?></div>
 <div class="image">     <?php echo '<img src="uploads/' . $post['image'] . '" height="300" width="500">'; ?> </div>
            <div class="description"><?php echo $post["description"]; ?></div>
            <!-- Add delete button with a form for each post -->
            <form method="post" action="">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" name="delete_post" class="delete-btn"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    <?php } ?>
</div>

<br>
<br>
<br>

</body>
</html>
