<?php 
require_once "config.php"; 
session_start();

$title = $content = $admin_id = $category_id = $message = $postpic = "";

$errors = ['title' => '', 'content' => '', 'admin_id' => '', 'category_id' => '' , 'postpic' => ''];

if (isset($_POST['addpost'])){

    if(empty($_POST['title'])){
        $errors['title'] = "Title is Required". "<br />";
    } else {
        $title = mysqli_real_escape_string($con, $_POST['title']);
        if (!preg_match('/^[a-zA-Z0-9,\s]+$/', $title)) {
            $errors['title'] = "Input a Valid Title". "<br />";
        }
    }

    if(empty($_POST['content'])){
        $errors['content'] = "Content is Required". "<br />";
    } else {
        $content = mysqli_real_escape_string($con, $_POST['content']);
        if (strlen($content) < 10) {
            $errors['content'] = "Content must be at least 10 characters long.";
        }
    }

    if ( $_POST['admin_id'] <= 0) {
        $errors['admin_id'] =  "Invalid Admin ID.";
    } else {
        $admin_id = (int)$_POST['admin_id'];
    }

    if ($_POST['category_id'] <= 0) {
        $errors['category_id'] =  "Invalid Category ID.";
    } else {
        $category_id = (int)$_POST['category_id'];
    }


    if (!empty($_FILES['postpic']['name'])) {
      $allowedExtensions = ['jpg', 'jpeg', 'png'];
      $fileName = $_FILES['postpic']['name'];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      if (!in_array($fileExtension, $allowedExtensions)) {
          $errors['postpic'] = "Invalid file format. Allowed formats: jpg, jpeg, png." . "<br />";
      } else {
          $postpic = 'postuploads/' . uniqid() . '.' . $fileExtension;
          move_uploaded_file($_FILES['postpic']['tmp_name'], $postpic);
      }
    }
  

    if (array_filter($errors)){
      $message = "THERE IS AN ERROR ON YOUR FORM";
    } else {
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
        $admin_id = (int)$_POST['admin_id'];
        $category_id = (int)$_POST['category_id'];

        $sql = "INSERT INTO posts (title, content, admin_id, category_id, postpic) VALUES ('$title', '$content', '$admin_id', '$category_id', '$postpic')";
        $query = mysqli_query($con, $sql);

            if ($query){
                $message = "Post Added Successfully.";
            } else {
                $message = "Unable to Submit your Post. Try again later.";
            }
    }

}





?>

<?php require('header.php');?> 
<style>

.body {
    font-family: Arial, sans-serif;
    background-color: rgb(194, 246, 234);
    justify-content: center;
    display: flex;
    height: 100%;
    padding: 3rem;
  }
  h2, p{
    color: rgb(194, 246, 234);
  }

  .form-container {
    width: 500px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  

  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input,
  textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
  }
  
  textarea {
    resize: vertical;
  }
  
  input[type=submit] {
    background-color: rgb(194, 246, 234);
    color: black;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  

  input:focus,
  textarea:focus {
    border-color: rgb(194, 246, 234);
    outline: none;
  }
  
  input[type=submit]:hover {
    background-color: black;
    color: rgb(194, 246, 234);
    border: 1px solid rgb(194, 246, 234);
  }
</style>
<title>Add Blog Post</title>
</head>
<body>
<?php require('nav.php');?> 
<center><h3 style="color: red; margin: 1px;"><?php if(isset($message)){echo $message;}?></h3></center>
<div class="body">    
    <div class="form-container">
        <h2>Add Blog Post</h2>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" placeholder="Enter Title" required>
            <p style="color: red;"><?php if(isset($errors['title'])){echo $errors['title'];}?></p>
          </div>
          <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" rows="4" placeholder="Input Content"  required></textarea>
            <p style="color: red;"><?php if(isset($errors['content'])){echo $errors['content'];}?></p>
          </div>
          <div class="form-group">
            <label for="admin_id">Admin ID:</label>
            <input type="number" name="admin_id" placeholder="Enter Admin ID" required>
            <p style="color: red;"><?php if(isset($errors['admin_id'])){echo $errors['admin_id'];}?></p>
          </div>
          <div class="form-group">
            <label for="category_id">Category ID:</label>
            <input type="number" name="category_id" placeholder="Enter Category ID" required>
            <p style="color: red;"><?php if(isset($errors['category_id'])){echo $errors['category_id'];}?></p>
          </div>
          <div class="form-group">
          <label for="postpic">Blog Post Image:</label>
          <input type="file" name="postpic" accept="image/*">
          <p style="color: red;"><?php if(isset($errors['postpic'])){echo $errors['postpic'];}?></p>
          </div>
          <div class="form-group">
            <input type="submit" name="addpost" value="Add Post">
          </div>
        </form>
    </div>
</div>

<?php require('footer.php');?> 


