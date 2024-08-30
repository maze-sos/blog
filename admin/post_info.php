<?php session_start();
require('header.php');?> 
<title>Post Details</title>
<style>
        .body {
            font-family: 'Arial', sans-serif;
            background-color: rgb(194, 246, 234);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .post-info-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 5rem;
            align-items: center;
        }

        h2 {
            color: rgb(194, 246, 234);
        }

        .post-details {
            margin-top: 20px;
        }

        .post-details p {
            margin-bottom: 10px;
        }

        .post-image {
            max-width: 50%;
            height: 50%;
            margin-top: 20px;
        }

        .button {
            background-color: rgb(194, 246, 234);
            color: black;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .button:hover {
            background-color: black;
            color: rgb(194, 246, 234);
        }
    </style>
</head>
<body>
<?php require('nav.php');?> 
<div class="body">
<div class="post-info-container">
        <h2>Post Details</h2>
        <div class="post-details">
            <?php
                require_once "config.php";

                if (isset($_GET['id'])) {
                    $postId = mysqli_real_escape_string($con, $_GET['id']);

                    $sql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
                    FROM posts
                    INNER JOIN admin ON posts.admin_id = admin.id
                    INNER JOIN categories ON posts.category_id = categories.id
                    WHERE posts.id = '$postId'";

                    $result = mysqli_query($con, $sql);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $image = empty($row['postpic']) ? 'default-profile-pic.jpg' : $row['postpic'];
                        echo "<img src='{$image}' alt='Post Image' class='post-image'>";
                        echo "<p><strong>ID:</strong> {$row['id']}</p>";
                        echo "<p><strong>Title:</strong> {$row['title']}</p>";
                        echo "<p><strong>Admin:</strong> {$row['admin_name']}</p>";
                        echo "<p><strong>Category:</strong> {$row['category_name']}</p>";
                        echo "<p><strong>Created At:</strong> {$row['created_at']}</p>";
                        echo "<p>{$row['content']}</p>";
                    } else {
                        echo "<p>Post not found</p>";
                    }
                } else {
                    echo "<p>Invalid request</p>";
                }

                mysqli_close($con);
            ?>
        </div>
        <a href="viewpost.php" class="button">Back to Post List</a>
        <a href="editpost.php?&id=<?php echo htmlspecialchars($row['id']); ?> " class="button">Edit Post</a>
        <a href="deletepost.php?&id=<?php echo htmlspecialchars($row['id']); ?> " class="button">Delete Post</a>
    </div>
</div>    
<?php require('footer.php');?> 