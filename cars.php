<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Catalog</title>
<!-- Add this line in the head section of your HTML file -->
<link rel="stylesheet" type="text/css" href="cars.css">


</head>

<body>
    <header>
    <div class="header-container">
        <h1>DHAKA METRO GA</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="posts_with_search.php">Posts</a>
            <a href="cars.php">CARS</a>
            <a href="admin_login.php">Admin</a>
            <a href="login.php">Signin</a>
            <a href="register.php">Register</a>
            <br>
            <br>
            <form action="cars.php" method="GET" class="search-form">
                <label for="search"></label>
                <input type="text" name="search" id="search" placeholder="Enter car model">
                <input type="submit" value="Search">
            </form>
            </nav>
    </header>

            <form action="compare_cars.php" method="POST" class="compare-form">
                <label for="carType1">Select Car Type 1:</label>
                <select name="carType1" id="carType1">
                    <option value="">Any</option>
                    <?php echo getOptionsFromDatabase("car_model"); ?>
                </select>

                <label for="carType2">Select Car Type 2:</label>
                <select name="carType2" id="carType2">
                    <option value="">Any</option>
                    <?php echo getOptionsFromDatabase("car_model"); ?>
                </select>

                <input type="submit" value="Compare Cars">
            </form>

            <!-- New code for sorting filters -->
            <form action="cars.php" method="GET" class="sort-form">
                <label for="yearFilter">Sort by Year:</label>
                <select name="yearFilter" id="yearFilter">
                    <option value="">Any</option>
                    <?php echo getOptionsFromDatabase("car_year"); ?>
                </select>

                <label for="priceFilter">Sort by Price:</label>
                <select name="priceFilter" id="priceFilter">
                    <option value="">Any</option>
                    <option value="asc">Low to High</option>
                    <option value="desc">High to Low</option>
                </select>

                <input type="submit" value="Apply Filters">
            </form>
    

    <!-- <h2>Car Catalog</h2> -->

    <div class="car-container">
        <?php
$connection = mysqli_connect("","","",""); //your dataabse information

        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $yearFilter = isset($_GET['yearFilter']) ? $_GET['yearFilter'] : '';
        $priceFilter = isset($_GET['priceFilter']) ? $_GET['priceFilter'] : '';

        $query = "SELECT * FROM cars WHERE car_model LIKE '%$search%'";

        if (!empty($yearFilter)) {
            $query .= " AND car_year = '$yearFilter'";
        }

        if (!empty($priceFilter)) {
            $query .= " ORDER BY car_price " . ($priceFilter == 'asc' ? 'ASC' : 'DESC');
        }

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="car-item">';
                echo '<img src="uploads/' . $row["car_image"] . '" alt="' . $row["car_model"] . '" class="car-image" onclick="openCarDetails(' . $row["idcars"] . ')">';
                echo '<h3>' . $row["car_model"] . '</h3>';
                echo '</div>';
            }
        } else {
            echo "No cars found.";
        }

        mysqli_close($connection);
        ?>
    </div>

    <script>
        function openCarDetails(carId) {
            window.open('car_details.php?id=' + carId, '_blank');
        }
    </script>

    <?php
    // Function to get distinct options from the database
    function getOptionsFromDatabase($column) {
        $connection = mysqli_connect("","","",""); //your dataabse information

        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT DISTINCT $column FROM cars";
        $result = mysqli_query($connection, $query);

        $options = "";
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $value = $row[$column];
                $options .= "<option value=\"$value\">$value</option>";
            }
        }

        mysqli_close($connection);

        return $options;
    }
    ?>
</body>
</html>
