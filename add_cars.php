
<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Car</title>

    <link rel="stylesheet" type="text/css" href="add_cars.css">
    <link rel="stylesheet" type="text/css" href="thome.css">


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
            
        </nav>
    </header>

    <h2>Add Car</h2>
    <div class="form">
    <form action="admin_add_cars.php" method="post" enctype="multipart/form-data">

        <label>Model:</label>
        <input type="text" name="car_model" required>
        <br><br>
       

        <label>Type:</label>
        <select name="car_type" required>
            <option value="sedan">Sedan</option>
            <option value="coupe">Coupe</option>
            <option value="suv">SUV</option>
         
        </select><br><br>

        <label>Year:</label>
        <input type="number" name="car_year" required><br><br>

        <label>Image:</label>
        <input type="file" name="car_image" accept="image/*" ><br><br>

        
        <label>Price:</label>
        <input type="number" name="car_price" required><br><br>

        <label>Description:</label>
        <textarea name="car_description"  required class="description"></textarea><br><br>

        <input type="submit" value="Add Car">
    </form>
    </div>
</body>
</html>
