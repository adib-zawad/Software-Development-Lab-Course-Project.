<?php
session_start();
$connection = mysqli_connect("","","",""); //your dataabse information

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['car_model'];
    $type = $_POST['car_type'];
    $year = $_POST['car_year'];
    $description = $_POST['car_description'];
    $price = $_POST['car_price'];

    // Handle image upload
    $image_name = $_FILES['car_image']['name'];
    $image_size = $_FILES['car_image']['size'];
    $image_tmp_name = $_FILES['car_image']['tmp_name'];
    $image_folder = 'uploads/' . $image_name;

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($image_folder, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "jfif","webp","avif"])) {
        echo "Sorry, only JPG, JPEG, PNG, and JFIF files are allowed.";
    } else {
        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO cars (car_model, car_type, car_year, car_image, car_description, car_price) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssisss", $model, $type, $year, $image_name, $description, $price);

            if (mysqli_stmt_execute($stmt)) {
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "Car details added successfully.";
                header("Location: add_cars.php");
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($connection);
        }
    }
}

mysqli_close($connection);
?>
