<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="admin_login.css">
</head>

<body>
<header>
        <h1>DHAKA METRO GA</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="posts_with_search.php">Posts</a>
            <a href="cars.php">CARS</a>
        </nav>
    </header>
    <div class="wrapper">
    <div class="container">

    <form action="admin_login_process.php" method="post" class="form">
        <h2 class="h2">Admin Login</h2>
        <label for="admin_username">Username:</label>
        <input type="text" name="admin_username" required><br><br>
        <label for="admin_password">Password:</label>
        <input type="password" name="admin_password" required><br><br>
        <input type="submit" value="Login">
        <br>
    </form>
    </div>
    <div class="cover"></div>
</div>
</body>
</html>
