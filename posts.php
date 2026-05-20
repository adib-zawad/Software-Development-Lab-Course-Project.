<?php
$con = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT * FROM posts ORDER BY post_id DESC"; // Retrieve all users in order of their IDs
// $result = $conn->query($sql);

// $posts = array(); // An array to store user data

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $posts[] = $row;
//     }
// }



$sql = "           
SELECT p.post_id, p.post_uploader,p.title, p.post_description, p.image, u.username, u.profile_image
FROM posts p, users u
WHERE p.post_uploader = u.username
ORDER BY p.post_id DESC"; 
$result = $conn->query($sql);

$posts = array(); // An array to store user data

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
</head>
<body>

<header>
        <h1>DHAKA METRO GA</h1>
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
       <div class=profile-image> <?php echo '<img src="uploads/' . $post['profile_image'] . '" height="40" width="100">'; ?> </div>
<br>
<br>
     <div class="title"> <?php echo  $post["title"]; ?>  </div>
      <br>
      <br>
      <div class=image>    <?php echo '<img src="uploads/' . $post['image'] . '" height="300" width="500">'; ?> </div>
      <div class="description"> <?php echo $post["post_description"]; ?>  </div>
<br>
      <!-- <form action="comments.php" method="post" class="form" enctype="multipart/form-data">
       <input type="text" name="comment_description"  required><br><br>
      <input type="submit" value="comment" name="comment">

    </form> -->
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
