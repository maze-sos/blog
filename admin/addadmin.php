<?php 
require_once "config.php";
session_start();


$name = $email = $password = $message = $profilePic = "";

$errors = ['name' => '', 'email' => '', 'password' => '', 'profilePic' => '', 'confirmpassword' => ''];

if (isset($_POST['addadmin'])){
    if(empty($_POST['email'])){
        $errors['email'] = "E-Mail is Required". "<br />";
    } else {
        $email = mysqli_real_escape_string($con, $_POST['email']); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Input a Valid Email". "<br />";
        }
    }

    if(empty($_POST['name'])){
        $errors['name'] = "Name is Required". "<br />";
    } else {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = "Input a Valid Name". "<br />";
        }
    }

    if (!empty($_POST['password'])) {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmpassword'];
      if (strlen($password) < 8) {
          $errors['password'] = "Password must have at least 8 characters." . "<br />";
      } else if ($password !== $confirmPassword) {
        $errors['confirmpassword'] = "Passwords do not match.";
      } {
          $password = password_hash($password, PASSWORD_DEFAULT);
      }
    } else {
        $errors['password'] = "Password is Required." . "<br />";
    }

    if (!empty($_FILES['profilePic']['name'])) {
      $allowedExtensions = ['jpg', 'jpeg', 'png'];
      $fileName = $_FILES['profilePic']['name'];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      if (!in_array($fileExtension, $allowedExtensions)) {
          $errors['profilePic'] = "Invalid file format. Allowed formats: jpg, jpeg, png." . "<br />";
      } else {
          $profilePic = 'uploads/' . uniqid() . '.' . $fileExtension;
          move_uploaded_file($_FILES['profilePic']['tmp_name'], $profilePic);
      }
    }
  

    if (array_filter($errors)){
      $message = "THERE IS AN ERROR ON YOUR FORM";
    } else {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);

        $check_admin = "SELECT * FROM `admin` WHERE `email` = '$email' OR `name` = '$name' LIMIT 1";
        $result = mysqli_query($con, $check_admin);
        $admin = mysqli_fetch_assoc($result);

        if ($admin) {
            if ($admin['email'] == $email){
                $message = "Email already Exists!!!";
            }
            if ($admin['name'] == $name){
                $message = "Name already Exists!!!";           
            }
        } else {
            $sql = "INSERT INTO admin (name, email, password, profile_pic) VALUES ('$name', '$email', '$password', '$profilePic')";
            $query = mysqli_query($con, $sql);
  

            if ($query){
                $message = "Admin Added Successfully.";
            } else {
                $message = "Unable to Submit your data. Try again later.";
            }
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
<title>Add Admin</title>
</head>
<body>
<?php require('nav.php');?> 
<center><h3 style="color: red; margin: 1px;"><?php if(isset($message)){echo $message;}?></h3></center>
<div class="body">    
    <div class="form-container">
        <h2>Add Admin</h2>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter your Name" required>
            <p style="color: red;"><?php if(isset($errors['name'])){echo $errors['name'];}?></p>
          </div>
          <div class="form-group">
            <label for="name">Email:</label>
            <input type="email" name="email" placeholder="Enter your E-Mail" required>
            <p style="color: red;"><?php if(isset($errors['email'])){echo $errors['email'];}?></p>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your Password" required>
            <p style="color: red;"><?php if(isset($errors['password'])){echo $errors['password'];}?></p>
          </div>
          <div class="form-group">
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" placeholder="Confirm your Password" required>
            <p style="color: red;"><?php if(isset($errors['confirmpassword'])){echo $errors['confirmpassword'];}?></p>
          </div>
          <div class="form-group">
          <label for="profilePic">Profile Picture:</label>
          <input type="file" name="profilePic" accept="image/*">
          <p style="color: red;"><?php if(isset($errors['profilePic'])){echo $errors['profilePic'];}?></p>
          </div>
          <div class="form-group">
            <input type="submit" name="addadmin" value="Add Admin">
          </div>
        </form>
    </div>
</div>

<?php require('footer.php');?> 