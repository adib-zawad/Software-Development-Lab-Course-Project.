<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$con = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['username'])) {
        die("You must be logged in to comment.");
    }

    $commentText = trim($_POST['comment']);  // Trim to remove leading and trailing spaces
    $postId = $_POST['post_id'];
    $commenterUsername = $_SESSION['username'];

    // Check if the comment is not empty
    if (!empty($commentText)) {
        // Use prepared statement to prevent SQL injection
        $commentSql = "INSERT INTO comments (comment_post_id, comment_uploader, comment_description) VALUES (?, ?, ?)";
        $commentStmt = $conn->prepare($commentSql);
        $commentStmt->bind_param("iss", $postId, $commenterUsername, $commentText);
        $commentStmt->execute();
        $commentStmt->close();
    }

  //  Redirect to a new page after processing the form data
    header("Location: posts_with_search.php");
    exit();
}

$posts = array();

// Check if the search term is present
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    // Use prepared statement to prevent SQL injection
    $sql = "
        SELECT p.post_id, p.post_uploader, p.title, p.post_description, p.image, u.username, u.profile_image
        FROM posts p, users u
        WHERE p.post_uploader = u.username
        AND (p.title LIKE ? OR u.username LIKE ?)
        ORDER BY p.post_id DESC
    ";

    $stmt = $conn->prepare($sql);

    // Add wildcards to the keyword for a partial match
    $searchTerm = "%" . $keyword . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    $stmt->close();
} else {
    // Fetch all posts if no search term is present
    $sql = " SELECT p.post_id, p.post_uploader, p.title, p.post_description, p.image, u.username, u.profile_image 
        FROM posts p, users u
        WHERE p.post_uploader = u.username 
        ORDER BY p.post_id DESC
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>All Users</title>

    <style>
        /* Add your CSS styles for comments and replies here */
        .comment {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 20px;
            height: 10%;
       
           border-color: black;

        }
        .comment .add-comment{
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 20px;
           border-color: black;
           width: 400px;
        }
        .comment .profile-image {
            float: left;
            margin-right: 10px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="sm.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<header>
    <h1>DHAKA METRO GA</h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="posts_with_search.php">Posts</a>
        <a href="cars.php">CARS</a>
        <?php
        // Display login/logout based on session status
        if (isset($_SESSION['username'])) {
            echo '<a href="update_profile.php">Profile</a>';
            echo '<a href="welcome.php">Upload-posts</a>';
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Signin</a>';
          echo  '<a href="register.php">Register</a>';
          echo  '<a href="admin_login.php">Admin</a>';
        }
        ?>
       
        <br>
        <br>
        <div class="search-bar">  <form method="post" action="" id="searchForm">
            <div class=search-bar>  <input type="text" name="keyword" id="keyword" placeholder="Search "> </div>
        </form></div>
      
    </nav>
</header>
<br>
<div class="post-container">
    <?php foreach ($posts as $post) { ?>
        
        <div class="post">
        <div class="profile">    

                <div class="profile-image">
                    <?php echo '<img src="uploads/' . $post['profile_image'] . '" height="60" width="60" border-radius: 50%;">'; ?>
                </div>

                <div class="uploader">
                 <h1> <strong> <?php echo  $post["post_uploader"]; ?></strong> </h1>
                </div>
        
         </div>       
                   
                  
                
                
            <strong><div class="title"> <?php echo  $post["title"]; ?>  </div></strong>    

            <br>
            <div class="content-section">
                <div class="image"> <?php echo '<img src="uploads/' . $post['image'] . '" height="300" width="500">'; ?> </div>
                <div class="description"> <?php echo $post["post_description"]; ?>  </div>
            </div>
            <br><br>
            <!-- Display existing comments for the post -->
            <?php
            $postId = $post['post_id'];
            $commentsSql = "SELECT * FROM comments WHERE comment_post_id = ? ORDER BY comment_id DESC";
            $commentsStmt = $conn->prepare($commentsSql);
            $commentsStmt->bind_param("i", $postId);
            $commentsStmt->execute();
            $commentsResult = $commentsStmt->get_result();

            while ($comment = $commentsResult->fetch_assoc()) {
                echo '<div class="comment">';
                echo '<div class="profile-image">';
                // echo '<img src="uploads/' . $comment['profile_image'] . '" height="50" width="50" border-radius: 50%;">';
                echo '</div>';
                echo '<strong>' .  $comment['comment_uploader'] . ':</strong> ' . $comment['comment_description'];

                if (isset($_SESSION['username']) && $_SESSION['username'] === $comment['comment_uploader']) {
   echo ' <a href="?delete_comment=' . $comment['comment_id'] . '">      
                                                                                                           
                                                                     
   <img src="delete-comment.png" alt="Delete" height="13" width="15"></a> ';     
                       }


                echo '</div>';
            }

            $commentsStmt->close();

            // Handle comment deletion
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_comment'])) {
    $commentIdToDelete = $_GET['delete_comment'];

    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['username'])) {
        die("You must be logged in to delete a comment.");
    }

    // Check if the logged-in user is the owner of the comment
    $checkOwnershipSql = "SELECT comment_uploader FROM comments WHERE comment_id = ?";
    $checkOwnershipStmt = $conn->prepare($checkOwnershipSql);
    $checkOwnershipStmt->bind_param("i", $commentIdToDelete);
    $checkOwnershipStmt->execute();
    $checkOwnershipResult = $checkOwnershipStmt->get_result();
    $commentOwner = $checkOwnershipResult->fetch_assoc()['comment_uploader'];
    $checkOwnershipStmt->close();

    if ($_SESSION['username'] === $commentOwner) {
        // User is the owner of the comment, proceed with deletion
        $deleteCommentSql = "DELETE FROM comments WHERE comment_id = ?";
        $deleteCommentStmt = $conn->prepare($deleteCommentSql);
        $deleteCommentStmt->bind_param("i", $commentIdToDelete);
        $deleteCommentStmt->execute();
        $deleteCommentStmt->close();

        // Redirect to the same page after deleting the comment
        header("Location: {$_SERVER['PHP_SELF']}?post_id={$postId}");
        exit();
    } else {
        die("You don't have permission to delete this comment.");
    }
}

?>
            <!-- Form for users to add comments -->
     <div class="add-comment">
     <form method="post" action="">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <textarea name="comment" placeholder="Add a comment"></textarea>
                <br>
               <button type="submit">Post Comment</button> 
            </form>
     </div>     
        </div>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        // Bind the input field to the keyup event
        $('#keyword').keyup(function() {
            // Get the value of the input field
            var keyword = $(this).val();

            // Perform an AJAX request to update the search results
            $.ajax({
                type: 'POST',
                url: 'posts_with_search.php', // Change this to the URL of your PHP file
                data: { keyword: keyword },
                success: function(response) {
                    $('.post-container').html(response);
                }
            });
        });
    });
</script>

</body>
</html>