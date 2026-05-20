<?php
$con = mysqli_connect("","","",""); //your dataabse information

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM featured_posts ORDER BY id DESC";
$result = $conn->query($sql);

$posts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

// Close the result set, but keep the connection open for subsequent queries
$result->close();

// Now, you can use the same connection for the next query
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHAKA METRO GA</title>
    <link rel="stylesheet" type="text/css" href="home4.css">
    <style>

   

    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <header>
        <h1>DHAKA METRO GA</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="posts_with_search.php">Posts</a>
            <a href="cars.php">Cars</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="admin_login.php">Admin</a>
        </nav>
    </header>

    <div class="main-content">
        <div class="slider-container">
            <div class="slider">
                <?php foreach ($posts as $index => $post) { ?>
                    <div class="slide">
                        <a href="featured_posts_details.php?id=<?php echo $post['id']; ?>">     </a>

                            <div class="post" data-post-id="<?php echo $post['id']; ?>">
                                <div class="title"><strong><h1><?php echo $post["title"]; ?></h1></strong></div>
                                <div class="image"><?php echo '<img src="uploads/' . $post['image'] . '">'; ?></div>
                            </div>
                    </div>
                <?php } ?>
            </div>
            <div class="dots"></div>
            <div class="arrow-container">
                <div class="left-arrow">&larr;</div>
                <div class="right-arrow">&rarr;</div>
            </div>
            <br>
            <br><br>
            <br>

            <div class="reg-form">  
                 <form action="register_process.php" method="post" class="form" enctype="multipart/form-data">
                    <h2>Register to share your experiences</h2>
                    <strong>Username: <input type="text" name="username" required></strong><br><br>
                    <strong>Password: <input type="password" name="password" required></strong><br><br>
                    <strong>Image: <input type="file" name="profile_image" accept="profile_image/jpg, profile_image/jpeg, profile_image/png" ></strong>
                    <input type="submit" value="Register" name="submit"><br><br>
                    <strong><a href="login.php">Login</a></strong><br>
                </form>
            </div>
        </div>

        <div class="sidebar">
            <!-- Latest Posts Section -->
            <div class="latest-posts">
                <h1 >Latest Posts</h1>
                <?php
                $latestSql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3";
                $latestResult = $conn->query($latestSql);

                if ($latestResult->num_rows > 0) {
                    while ($latestPost = $latestResult->fetch_assoc()) {
                        echo '<a href="posts_with_search.php?id=' . $latestPost['post_id'] . '"> ';
                        echo '<div class="latest-post">';
                       echo ' <h3>' . $latestPost['title'] . '</h3>';
                        echo '<div class="latest-post-image"><img src="uploads/' . $latestPost['image'] . '"></div>';
                        echo '</div>';
                        echo '</a>';
                    }
                }
                $latestResult->close(); // Close the latest result set
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var slider = $('.slider');
            var dotsContainer = $('.dots');
            var arrowContainer = $('.arrow-container');
            var posts = <?php echo json_encode($posts); ?>;
            var currentIndex = 0;

            function showPost(index) {
                slider.css('transform', 'translateX(' + (-index * 100) + '%)');
                updateDots(index);
            }

            function nextPost() {
                currentIndex = (currentIndex + 1) % posts.length;
                showPost(currentIndex);
            }

            function prevPost() {
                currentIndex = (currentIndex - 1 + posts.length) % posts.length;
                showPost(currentIndex);
            }

            function goToPostDetails(postId) {
                window.location.href = 'featured_posts_details.php?id=' + postId;
            }

            function createDots() {
                for (var i = 0; i < posts.length; i++) {
                    dotsContainer.append('<div class="dot"></div>');
                }
                updateDots(0);
            }

            function updateDots(index) {
                dotsContainer.find('.dot').removeClass('active');
                dotsContainer.find('.dot').eq(index).addClass('active');
            }

            createDots();

            setInterval(nextPost, 3000);

            $('.left-arrow').click(prevPost);
            $('.right-arrow').click(nextPost);

            $('.dot').click(function () {
                var dotIndex = $(this).index();
                showPost(dotIndex);
            });

            $('.post').click(function () {
                var postId = $(this).data('post-id');
                goToPostDetails(postId);
            });
        });
    </script>
</body>

</html>
