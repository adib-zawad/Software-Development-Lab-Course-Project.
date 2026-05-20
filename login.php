<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
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

    <form action="login_process.php" method="post" class="form">
        <h2 class="h2">Login</h2>
        <strong>Username: <input type="text" name="username" required><br><br></strong>
        <strong>Password: <input type="password" name="password" required><br><br></strong>
        <input type="submit" value="Login">
        <br><br>
        <strong><a href="register.php">Signup?</a> </strong>
        <br>
        <br>
     

        <br><br>
    </form>
    <div class="cover"></div>
</body>
</html>
