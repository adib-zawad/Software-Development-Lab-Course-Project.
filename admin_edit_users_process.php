<?php
session_start();
error_reporting(E_ERROR | E_PARSE);


$connection = mysqli_connect("","","",""); //your dataabse information
//database username sometime sby default is root 
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
/*
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
   //$result = mysqli_query($connection, $sql);
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
     else {
      echo "not found";  
      //header("Location: index.php");
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $newName = $_POST['newName'];
        $newEmail = $_POST['newEmail'];

        $updateSql = "UPDATE users SET username = '$newName', email = '$newEmail' WHERE id = $id";
        if ($connection->query($updateSql) === TRUE) {
            header("Location: admin_display_users.php");
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }
}

else {
  echo "errrorororo";
   // header("Location: index.php");
}

*/

if(isset($_GET['update_user']))
{
  $id = $_GET['user_id'];
  $username = $_GET['username'];
  $email = $_GET['email'];
  
  $query = "UPDATE users SET username='$username', email='$email' WHERE user_id='$id'";
 
  $query_run = mysqli_query($connection, $query);

  if($query_run)
  {
      $_SESSION['status'] = "Data Updated Successfully";
      header("Location: admin_display_users.php");
  }
  else
  {
      $_SESSION['status'] = "Not Updated";
      echo"try again";
  }
}
else{
    echo"errors";
}


?>


