<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = $postId";
    $result = mysqli_query($con, $sql);
    $post = mysqli_fetch_assoc($result);

    if (!$post) {

        header("location: index.php");
        exit();
    }


    if (isset($_POST['delete'])) {
        $sqlDelete = "DELETE FROM posts WHERE id = $postId";
        $resultDelete = mysqli_query($con, $sqlDelete);

        if ($resultDelete) {

            header("location: index.php");
            exit();
        } else {

            echo "Error deleting post: " . mysqli_error($con);
        }
    }
} else {

    header("location: index.php");
    exit();
}
?>

<?php session_start();
require('header.php');?> 
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
.cancel-button{
    background-color: rgb(194, 246, 234);
    color: black;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    text-decoration: none;
    }
.cancel-button:hover {
    background-color: black;
    color: rgb(194, 246, 234);
    border: 1px solid rgb(194, 246, 234);
  }
.button {
    background-color: rgb(194, 246, 234);
    color: black;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  
  
.button:hover {
    background-color: black;
    color: rgb(194, 246, 234);
    border: 1px solid rgb(194, 246, 234);
  }
  .post-info-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 10rem;
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
</style>
<title>Delete Post</title>
</head>
<body>

<?php require('nav.php');?>
<div class="body">
<div class="post-info-container">
<h2>Delete Post</h2>
<div class="post-details">
    

    <p>Are you sure you want to delete the following post?</p>
    <p>Title: <?php echo $post['title']; ?></p>
    <p>Content: <?php echo $post['content']; ?></p>

    <form method="post">
        <input class="button" type="submit" name="delete" value="Delete Post">
        <a class="cancel-button" href="post_info.php">Cancel</a>
    </form>
    </div>
</div>
</div> 
<?php require('footer.php');?> 
