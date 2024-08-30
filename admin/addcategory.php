<?php 
require_once "config.php"; 
session_start();

$category = $message =  "";

$errors = ['category' => ''];

if (isset($_POST['addcategory'])){

    if(empty($_POST['category'])){
        $errors['category'] = "Category is Required". "<br />";
    } else {
        $category = mysqli_real_escape_string($con, $_POST['category']);
        if (!preg_match('/^[a-zA-Z0-9,\s]+$/', $category)) {
            $errors['category'] = "Input a Valid Category". "<br />";
        }
    }

    if (array_filter($errors)){
      $message = "THERE IS AN ERROR ON YOUR FORM";
    } else {
        $title = mysqli_real_escape_string($con, $_POST['category']);

        $sql = "INSERT INTO categories (category) VALUES ('$category')";
        $query = mysqli_query($con, $sql);

            if ($query){
                $message = "Category Added Successfully.";
            } else {
                $message = "Unable to Submit Category. Try again later.";
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
    padding: 13rem;
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
        <h2>Add New Category</h2>
        <form action="" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" placeholder="Enter New Category" required>
            <p style="color: red;"><?php if(isset($errors['category'])){echo $errors['category'];}?></p>
          </div>

          <div class="form-group">
            <input type="submit" name="addcategory" value="Add New Category">
          </div>
        </form>
    </div>
</div>

<?php require('footer.php');?> 