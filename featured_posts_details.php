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
        $id = $_GET['id'];

        $query = "SELECT * FROM featured_posts WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<div class='car-details-container'>";
            echo "<div class='car-image'>";
            echo "<img src='uploads/{$row['image']}'  style='max-width: 100%;'>";
            echo "</div>";

            echo "<div class='car-description'>";
            echo " <strong> <h2>{$row['title']}</h2>  </strong>";
            echo "<p>{$row['description']}</p>";
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
