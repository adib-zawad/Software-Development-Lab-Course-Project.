<?php
session_start();
error_reporting(E_ERROR | E_PARSE);


$connection = mysqli_connect("","","",""); //your dataabse information
//database username sometime sby default is root 
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}


if(isset($_GET['delete_user']))
{
  $id = $_GET['user_id'];
  
  
  $query = "DELETE FROM users WHERE user_id = $id";
 
  $query_run = mysqli_query($connection, $query);

  if($query_run)
  {
      $_SESSION['status'] = "user deleted successfully";
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


