<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="thome.css">
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
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


    
    <br>
    <form action="register_process.php" method="post" class="form" enctype="multipart/form-data">
    <h2>Registration</h2>
  <strong >     Username: <input type="text" name="username" required><br><br> </strong>
  <strong >     Password: <input type="password" name="password" required><br><br></strong>

  <strong >     Image: <input type="file" name="profile_image" accept="profile_image/jpg, profile_image/jpeg, profile_image/png" > </strong>
        <input type="submit" value="Register" name="submit">
  <br>
  <br>

        <strong >   <a href="login.php">Back to login</a> </strong>
        <br>
    </form>
    <div class="covers"></div>

</body>
</html>
