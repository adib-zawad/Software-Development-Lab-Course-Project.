<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Car Catalog</title>
    <link rel="stylesheet" type="text/css" href="car_details.css">
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

    <?php
$connection = mysqli_connect("","","",""); //your dataabse information

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $carId = $_GET['id'];

        $query = "SELECT * FROM cars WHERE idcars = $carId";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<div class='car-details-container'>";
            echo "<div class='car-image'>";
            echo "<img src='uploads/{$row['car_image']}' alt='{$row['car_model']}' style='max-width: 100%;'>";
            echo "</div>";

            echo "<div class='car-description'>";
            echo "<h2>{$row['car_model']}</h2>";
            echo "<p>Year: {$row['car_year']}</p>";
            echo "<p>Price: {$row['car_price']}$</p>";
            echo "<p>Type: {$row['car_type']}</p>";
            echo "<p>{$row['car_description']}</p>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "Car details not found.";
        }
    } else {
        echo "Invalid request.";
    }

    mysqli_close($connection);
    ?>

</body>

</html>
