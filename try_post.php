<?php
$conn = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts ORDER BY id DESC"; // Retrieve all users in order of their IDs
$result = $conn->query($sql);

$posts = array(); // An array to store user data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}


// $sql2 = "SELECT * FROM comments ORDER BY id DESC"; // Retrieve all users in order of their IDs
// $result2 = $conn->query($sql2);

// $comments = array(); // An array to store user data

// if ($result2->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $comments[] = $row;
//     }
// }

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="posts.css">
    <link rel="stylesheet" type="text/css" href="home.css">
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
      <div class="uploader"> <?php echo $post["uploader"]; ?>  </div>
      <div class="title"> <?php echo $post["title"]; ?>  </div>
      <?php echo '<img src="uploads/' . $post['image'] . '" height="100" width="100">'; ?>
      <div class="description"> <?php echo $post["description"]; ?>  </div>

      <br>
      <br>
    
      </div>  
            <?php } ?>
        
    

    </div>
    
<br>
<br>
<br>







</body>
</html>
