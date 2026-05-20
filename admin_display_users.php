
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);



$connection = mysqli_connect("","","",""); //your dataabse information

 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error); }


// SQL query to select all data from a table
$query = "SELECT user_id, username, email FROM users";

// Execute the query and store the result
$result = mysqli_query($connection, $query);
//$result = $conn->query($query);



echo "<td><a href='admin_edit_users.php?username=" . $row["username"] . "'>Edit</a> | <a href='admin_delete_users.php?username=" . $row["username"] . "'>Delete</a></td>";


// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Fetch the data and display it in an HTML table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["username"] . "</td>
                <td>" . $row["email"] . "</td>
    
              </tr>";


    }
    echo "</table>";
} else {
    echo "No data found";
}







// Close the database connection
mysqli_close($connection);
?>


</body>
</html>








