<?php

require_once "config.php";

$email = $password = $message = "";

$errors = ['email' => '', 'password' => ''];

session_start();

if(isset($_POST['login'])){
  if(empty($_POST['email'])){
        $errors['email'] = "E-Mail is Required". "<br />";
    } else {
        $email = mysqli_real_escape_string($con, $_POST['email']); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Input a Valid Email". "<br />";
        }
    }

    if (empty($_POST['password'])) {
      $errors['password'] = "Password is Required." . "<br />";
    } else {
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);
        }

    if (array_filter($errors)){
      $message = "THERE IS AN ERROR ON YOUR FORM";
    } else {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
  
    if (empty($email) || empty($password)){
      $message = "Email and Password are Required!!";
    } else {
        $sql = "SELECT * FROM `admin` WHERE email = '$email'";
        $query = mysqli_query($con, $sql);
        $result = mysqli_num_rows($query);
        if ($result == 1) {
            $row = mysqli_fetch_assoc($query);
            $name = $row['name'];
            if (password_verify($password, $row['password'])){
                    $_SESSION['admin_login'] = $name;
                    header("location: index.php");
                    exit();
                }else {
                $message = "Incorrect Password";
            }
        } else {
            $message = "Incorrect Email";
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
    padding: 10rem;
  }
  .form-container, h2{
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
  label{
    color: black;
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
<title>Admin Log In</title>
</head>
<body>
<?php require('nav.php');?> 

<center><h3 style="color: red; margin: 1px;"><?php if(isset($message)){echo $message;}?></h3></center>
<div class="body">    
    <div class="form-container">
        <h2>Admin Log In</h2>
        <form action="" method="POST">
          <div class="form-group">
            <label for="name">Email:</label>
            <input type="email" name="email" placeholder="Enter your Mail" required>
            <p style="color: red;"><?php if(isset($errors['email'])){echo $errors['email'];}?></p>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Your Password" required>
            <p style="color: red;"><?php if(isset($errors['password'])){echo $errors['password'];}?></p>
          </div>
          <div class="form-group">
            <input type="submit" name="login" value="Login">
          </div>
        </form>
    </div>
</div>

<?php require('footer.php');?> 