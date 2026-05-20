<?php
error_reporting(E_ERROR | E_PARSE);

$connection = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





// Check if the delete button is clicked
if (isset($_POST['delete_post'])) {
    $post_id_to_delete = $_POST['post_id'];


    // Delete comments associated with the post
$sql_delete_comments = "DELETE FROM comments WHERE comment_post_id = ?";
$stmt_delete_comments = $conn->prepare($sql_delete_comments);
$stmt_delete_comments->bind_param("i", $post_id_to_delete);
$stmt_delete_comments->execute();

    // Use prepared statement to prevent SQL injection
    $sql_delete = "DELETE FROM posts WHERE post_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $post_id_to_delete);
    $stmt_delete->execute();

    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}



$sql = "SELECT p.post_id, p.post_uploader, p.title, p.post_description, p.image, u.username, u.profile_image
        FROM posts p, users u
        WHERE p.post_uploader = u.username
        AND (p.title LIKE ? OR p.post_description LIKE ?)
        ORDER BY p.post_id DESC";

$stmt = $conn->prepare($sql);

// Add wildcards to the keyword for a partial match

$searchTerm = "%" . $_POST['keyword'] . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);

$stmt->execute();
$result = $stmt->get_result();

$posts = array(); // An array to store post data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}




// $sql = "SELECT p.post_id, p.post_uploader, p.title, p.post_description, p.image, u.username, u.profile_image
// FROM posts p, users u
// WHERE p.post_uploader = u.username
// AND (p.title LIKE ? OR p.post_description LIKE ?)
// ORDER BY p.post_id DESC";

// $result = $conn->query($sql);

// $posts = array(); // An array to store post data

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $posts[] = $row;
//     }
// }

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="tposts.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="tadmin_display_post.css">
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
            <div class="uploader"> <?php echo "By:". $post["post_uploader"]; ?>  </div>
            <div class="profile-image"> <?php echo '<img src="uploads/' . $post['profile_image'] . '" height="100" width="100">'; ?> </div>
            <br><br>
            <div class="title"> <?php echo  $post["title"]; ?>  </div>
            <br><br>
            <div class="image"> <?php echo '<img src="uploads/' . $post['image'] . '" height="300" width="500">'; ?> </div>
            <div class="description"> <?php echo $post["post_description"]; ?>  </div>
            <form method="post" action="">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <button type="submit" name="delete_post" class="delete-btn"><i class="fas fa-trash"></i></button>
            </form>
            <br><br>
        </div>
    <?php } ?>
</div>

<br>
<br>
<br>

</body>
</html>
