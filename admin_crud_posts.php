<?php
error_reporting(E_ERROR | E_PARSE);

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin-posts</title>
    <link rel="stylesheet" type="text/css" href="admin_crud_posts.css">
    


  </head>

  <header>
    <h1>DHAKA METRO GA</h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="posts_with_search.php">Posts</a>
        <a href="cars.php">CARS</a>
        <a href="admin_login.php">Admin</a>
        <a href="login.php">Signin</a>
        <a href="register.php">Register</a>
        <br>


    </nav>
</header>

<body>


    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <!-- <p>This is a protected page.</p> -->
    <h2>Create a new featured post</h2>
    <form action="admin_add_posts.php" method="post" class="form" enctype="multipart/form-data">
      title: <input type="text" name="title" required class="title-box"><br><br>
      description: <input type="text" name="description" required class="description-box"><br><br>
      Image: <input type="file" name="image"  accept="image/jpg, image/jpeg, image/png">

      <input type="submit" value="upload">
      <br>
      <a href="tadmin_display_featured_posts.php" class="btn" target="_blank">Display all featured posts</a>
      <br>
      <br>
   <div class="logout-btn"> <a href="logout.php">Logout</a> </div>
    <br>
    <br>

    <body>
    <html>