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
    <form method="GET" action="admin_edit_users_process.php">
    <label for="id">id:</label>
        <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>" required>
        <br>
        <label for="username">New Name:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
        <br>
        <label for="email">New Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <br>
        <input type="submit"  name="update_user" id="update_user"  value="update_user">
    </form>
 
</body>
</html>
