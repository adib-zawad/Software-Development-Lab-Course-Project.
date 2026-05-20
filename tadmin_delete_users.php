<?php
// Delete functionality
if (isset($_GET['id'])) {
    $connection = mysqli_connect("","","",""); //your dataabse information

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE user_id = $id";

    if (mysqli_query($connection, $query)) {
       header("Location: tadmin_display_users.php");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>
