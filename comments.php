<?php
error_reporting(E_ERROR | E_PARSE);

session_start();
$comment_uploader = $_SESSION['username'];
$post_id = $_SESSION['post_id'];

$connection = mysqli_connect("","","",""); //your dataabse information
//database username sometime sby default is root 
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}



// Retrieve user input
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$comment_description = $_POST['comment_description'];





// Insert user data into the database
$query = "INSERT INTO comments (comment_description, comment_uploader) VALUES ('$comment_description', '$comment_uploader') where post_id = '$post_id'";

if (mysqli_query($connection, $query)) {
    header("Location: posts.php");
} else {
    echo "Error: " . mysqli_error($connection);
}


}
mysqli_close($connection);
?>
