<?php
$connection = mysqli_connect("","","",""); //your dataabse information

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve selected car types from the form
$carType1 = isset($_POST['carType1']) ? $_POST['carType1'] : '';
$carType2 = isset($_POST['carType2']) ? $_POST['carType2'] : '';

// Fetch car details for each selected car type
$cars = [];
if (!empty($carType1)) {
    $cars['car1'] = fetchCarDetails($connection, $carType1);
}
if (!empty($carType2)) {
    $cars['car2'] = fetchCarDetails($connection, $carType2);
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compare Cars</title>
    <link rel="stylesheet" type="text/css" href="compare_cars.css">
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

    <!-- <h2>Compare Cars</h2> -->

    <div class="compare-container">
        <?php
        foreach ($cars as $key => $car) {
            // Generate car details page URL with car ID
            $carDetailsURL = 'car_details.php?id=' . $car['idcars'];

            echo '<a href="' . $carDetailsURL . '" class="car-link">'; // Wrap in anchor tag
            echo '<div class="car-container">';
            echo '<div class="car-item">';
            echo '<h3>' . $car["car_model"] . '</h3>';
            echo '<img src="uploads/' . $car["car_image"] . '" alt="' . $car["car_model"] . '" class="car-image" >';
            echo '<p>Year: ' . $car["car_year"] . '</p>';
            echo '<p>Price: $' . $car["car_price"] . '</p>';
            echo '<p>Type: ' . $car["car_type"] . '</p>';

            // Add more specifications as needed
            echo '</div>';
            echo '</div>';
            echo '</a>'; // Close anchor tag
        }
        ?>
    </div>

</body>
</html>

<?php
function fetchCarDetails($connection, $carType) {
    $query = "SELECT * FROM cars WHERE car_model = '$carType'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
?>
