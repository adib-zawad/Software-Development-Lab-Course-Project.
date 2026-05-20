<?php
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="welcome.css">
</head>
<body>

<header>
        <h1>DHAKA METRO GA</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="posts_with_search.php">Posts</a>
            <a href="Profile.php">Profile</a>
            <button> <a href="logout.php">Logout</a>  </button>
           
  
        </nav>
    </header>

    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <!-- <p>This is a protected page.</p> -->


    <h2>Create a new post!</h2>
    <form action="createpost_process.php" method="post" class="form" enctype="multipart/form-data">
   <div class="title">   <strong> title: <input type="text" name="title" required class="title-box" ><br><br>  </strong> </div>
    <div class="description">  <strong> description: <input type="text" name="post_description" required  class="description-box"><br><br>   </strong> </div> 
      
    <div class="image">   <strong> Image: <input type="file" name="image"  accept="image/jpg, image/jpeg, image/png">  </strong> </div>   
    
      <input type="submit" value="submit" name="submit"  >
      <br>
      <br>

  
</body>
</html>
