<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tadmin_display_users.css">
    <link rel="stylesheet" type="text/css" href="thome.css">

    <title>User Management</title>
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
    session_start();
    error_reporting(E_ERROR | E_PARSE);

    $connection = mysqli_connect("","","",""); //your dataabse information

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Function to sanitize input
    function sanitize($data) {
        return htmlspecialchars(strip_tags($data));
    }

    // Search functionality
    if (isset($_POST['search'])) {
        $searchTerm = sanitize($_POST['search']);
        $query = "SELECT user_id, username, email FROM users WHERE username LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    } else {
        $query = "SELECT user_id, username, email FROM users";
    }

    $result = mysqli_query($connection, $query);
    ?>


    <div class="search-container">
    <!-- Search form -->
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search username">
        <button type="submit">Search</button>
    </form>
</div>



   <?php
    echo '<div class="container">';
    // Table header
    echo '<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["user_id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>
          <a href='tadmin_delete_users.php?id=" . $row["user_id"] .  "'><img src='rsz_delete-icon.png' alt='Delete' ></a>  </div>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }

    echo '</table>';
    echo '</div>';

    mysqli_close($connection);
    ?>


</body>
</html>
