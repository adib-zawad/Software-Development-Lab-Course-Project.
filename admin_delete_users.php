<?php
session_start();
error_reporting(E_ERROR | E_PARSE);




?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Edit User</h2>
    <form method="GET" action="admin_delete_users_process.php">
    <label for="id">id:</label>
        <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>" required>
        <br>
        <input type="submit"  name="delete_user" id="delete_user"  value="delete_user">
    </form>
 
</body>
</html>
