<?php
$connection = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT * FROM posts ORDER BY id DESC"; // Retrieve all users in order of their IDs

$sql = "SELECT 
 posts.post_id, posts.title ,posts.image ,posts.post_description, posts.post_uploader,
 comments.comment_id, comments.comment_description, comments.comment_uploader, comments.post_id,
    users.username 
          FROM posts 
          LEFT JOIN comments ON posts.post_id = comments.post_id 
          LEFT JOIN users ON comments.comment_uploader = users.username";

$result = $conn->query($sql);

$posts = array(); // An array to store posts and comments

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $post_id = $row['post_id'];
        if (!isset($posts[$post_id])) {
            // Create a new post entry in the array if it doesn't exist
            $posts[$post_id] = array(
                'post_uploader' => $row['post_uploader'],
                'title' => $row['title'],
                'image' => $row['image'],
                'post_description' => $row['post_description'],
                'comments' => array()
            );
        }

        // Append comments to the respective post
        if (!empty($row['comment_id'])) {
            $posts[$post_id]['comments'][] = array(
                'comment_description' => $row['comment_description'],
                'username' => $row['username']
            );
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="posts.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    
</head>
<body>

<header>
        <h1>PhoneField</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="posts.php">Posts</a>
            <a href="admin_login.php">Admin</a>
            <a href="login.php">Signin</a>
            <a href="register.php">Register</a>
        </nav>
    </header>

<h2>Posts</h2>

<div class="post-container">

  
<?php foreach ($posts as $post) { ?>
    <div class="post">
    <div class="uploader"> <?php echo $post["post_uploader"]; ?>  </div>
      <div class="title"> <?php echo $post["title"]; ?>  </div>
      <?php echo '<img src="uploads/' . $post['image'] . '" height="100" width="100">'; ?>
      <div class="description"><?php echo $post['post_description']; ?></div>
        <ul class="comments">
            <?php foreach ($post['comments'] as $comment) { ?>
                <li>
                    <p><?php echo $comment['comment_description']; ?></p>
                    <p>Comment by: <?php echo $comment['username']; ?></p>
                </li>
     <form method="post" action="comments.php">
        <input type="hidden" name="post_id" value="post_is"> <!-- Change 1 to the actual post ID -->
        <input type="text" name="comment_description" placeholder="Your comment">
        <input type="text" name="username" placeholder="Your username">
        <input type="submit" value="Add Comment">
    </form>

            <?php } ?>
        </ul>
    </div>
<?php } ?>             
 



 <br>  
<br>
 </div>  
   
  
<br>
<br>
<br>







</body>
</html>
