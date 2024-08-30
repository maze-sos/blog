<?php
require_once "config.php"; 
session_start();

if (!isset($_SESSION['admin_login'])){
    header("location: login.php");
    exit();
}


$adminName = $_SESSION['admin_login'];


$sql = "SELECT `id`, `name`, `email`, `password`, `profile_pic` FROM `admin` WHERE `name` = '$adminName'";


$result = mysqli_query($con, $sql);


$admins = mysqli_fetch_assoc($result);


$sqlPosts = "SELECT COUNT(*) AS postCount FROM posts";
$resultPosts = mysqli_query($con, $sqlPosts);
$rowPosts = mysqli_fetch_assoc($resultPosts);
$postCount = $rowPosts['postCount'];


$sqlUsers = "SELECT COUNT(*) AS userCount FROM users";
$resultUsers = mysqli_query($con, $sqlUsers);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$userCount = $rowUsers['userCount'];

$sqlAdmins = "SELECT COUNT(*) AS adminCount FROM admin";
$resultAdmins = mysqli_query($con, $sqlAdmins);
$rowAdmins = mysqli_fetch_assoc($resultAdmins);
$adminCount = $rowAdmins['adminCount'];

$sqlCat = "SELECT COUNT(*) AS catCount FROM categories";
$resultCat = mysqli_query($con, $sqlCat);
$rowCat = mysqli_fetch_assoc($resultCat);
$catCount = $rowCat['catCount'];


$sqlVisitors = "SELECT COUNT(*) AS total_visitors FROM visitors";
$resultVisitors = mysqli_query($con, $sqlVisitors);
$rowVisitors = mysqli_fetch_assoc($resultVisitors);
$totalVisitors = $rowVisitors['total_visitors'];


$sqlVisits = "SELECT COUNT(*) AS total_visits FROM visits";
$resultVisits = mysqli_query($con, $sqlVisits);
$rowVisits = mysqli_fetch_assoc($resultVisits);
$totalVisits = $rowVisits['total_visits'];

?>

<?php require('header.php');?> 
<title>Admin Dashboard</title>
<style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    #sidebar {
      width: 250px;
      height: 100%;
      background-color: rgb(194, 246, 234);
      color: black;
      padding-top: 20px;
      float: left;
    }

    #content {
      margin-left: 250px;
      padding: 20px;
    }

    .profile {
      text-align: center;
      margin-bottom: 5rem;
      margin-top: 2rem;
    }

    .profile img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile h4 {
      color: black;
      margin-top: 10px;
    }

    .nav-list {
      list-style-type: none;
      padding: 0;
      display: grid;
      margin-bottom: 23rem;
      height: 100%;
    }

    .nav-item {
      padding: 10px;
      color: black;
      text-decoration: none;
      display: block;
      transition: background-color 0.3s;
      position: relative;
      margin-bottom: 20px;
    }

    .nav-item:hover {
      background-color: black;
      color: rgb(194, 246, 234);
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: rgb(194, 246, 234);
      border: 0.5px solid black;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .nav-item:hover .dropdown-content {
      display: block;
    }

    .dropdown-item {
      padding: 10px;
      color: black;
      text-decoration: none;
      border-bottom: 0.5px solid black;
      display: block;
    }
    .dropdown-item:hover {
      padding: 10px;
      color: rgb(194, 246, 234);
      background-color: black;
      text-decoration: none;
      border-bottom: 0.5px solid black;
      display: block;
    }

    .cards {
      background-color: black;
      justify-content: center;
      display: flex;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card {
      background-color: rgb(194, 246, 234);
      color: black;
      padding: 20px;
      margin: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .post-list {
      list-style-type: none;
      padding: 0;
    }

    .post-item {
      color: rgb(194, 246, 234);
    }
    .post-list {
            background-color: black;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 73rem;
        }
        h2{
          color: black;
        }
        table {
            width: 73rem;
            border-collapse: collapse;
            color: rgb(194, 246, 234);
        }


        th {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: black;
            background-color: rgb(194, 246, 234);
        }
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .more-info-button {
            background-color: rgb(194, 246, 234);
            color: black;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .more-info-button:hover {
            background-color: black;
            color: rgb(194, 246, 234);
        }
</style>
</head>

<body>
<?php require('nav.php');?> 
<div id="sidebar">
    <div class="profile">
    <?php
        if (!empty($admins)) {
            $name = htmlspecialchars($admins['name']);
            $profilePic = isset($admins['profile_pic']) ? htmlspecialchars($admins['profile_pic']) : 'default_profile_pic.jpg';
            ?>
            <img src='<?php echo $profilePic; ?>' alt='Profile Picture'>
            <h4><?php echo $name; ?></h4>
    <?php } ?>
    </div>

    <ul class="nav-list">
      <li class="nav-item">
        Admins
        <div class="dropdown-content">
          <a href="addadmin.php" class="dropdown-item">Add Admin</a>
          <a href="viewadmin.php" class="dropdown-item">View Admins</a>
        </div>
      </li>
      <li class="nav-item">
        Posts
        <div class="dropdown-content">
          <a href="addpost.php" class="dropdown-item">Add Post</a>
          <a href="viewpost.php" class="dropdown-item">View Posts</a>
        </div>
      </li>
      <li class="nav-item">
        Categories
        <div class="dropdown-content">
          <a href="addcategory.php" class="dropdown-item">Add Category</a>
          <a href="viewcategory.php" class="dropdown-item">View Categories</a>
        </div>
      </li>
      <li class="nav-item">
        Users
        <div class="dropdown-content">
          <a href="adduser.php" class="dropdown-item">Add User</a>
          <a href="viewuser.php" class="dropdown-item">View Users</a>
        </div>
      </li>
      <li class="nav-item">
        Visitors
        <div class="dropdown-content">
          <a href="viewvisitor.php" class="dropdown-item">View Visitors</a>
          <a href="viewvisit.php" class="dropdown-item">View Visits</a>
        </div>
      </li>
    </ul>
  </div>

  <div id="content">
    <div class="cards">
    <div class="card">
      <h2>Total Number of Admins:</h2>
      <p><?php echo $adminCount; ?> <?php if ($adminCount <=1) { ?> <?php echo 'Admin';?>
      <?php } else { ?><?php echo 'Admins';?><?php }?></p>
      <a href="viewadmin.php" class="dropdown-item">View <?php if ($adminCount <=1) { ?> <?php echo 'Admin';?>
      <?php } else { ?><?php echo 'Admins';?><?php }?></a>
    </div>

    <div class="card">
      <h2>Total Number of Posts:</h2>
      <p><?php echo $postCount; ?> <?php if ($postCount <=1) { ?> <?php echo 'Post';?>
      <?php } else { ?><?php echo 'Posts';?><?php }?></p>
      <a href="viewpost.php" class="dropdown-item">View <?php if ($postCount <=1) { ?> <?php echo 'Post';?>
      <?php } else { ?><?php echo 'Posts';?><?php }?></a>
    </div>

    <div class="card">
      <h2>Total Number of Categories:</h2>
      <p> <?php echo $catCount; ?> <?php if ($catCount <=1) { ?> <?php echo 'Category';?>
      <?php } else { ?><?php echo 'Categories';?><?php }?></p>
      <a href="viewcategory.php" class="dropdown-item">View <?php if ($catCount <=1) { ?> <?php echo 'Category';?>
      <?php } else { ?><?php echo 'Categories';?><?php }?></a>
    </div>

    </div>

    <div class="cards">
    
    <div class="card">
      <h2>Total Number of Users:</h2>
      <p><?php echo $userCount; ?> <?php if ($userCount <=1) { ?> <?php echo 'User';?>
      <?php } else { ?><?php echo 'Users';?><?php }?></p>
      <a href="viewuser.php" class="dropdown-item">View <?php if ($userCount <=1) { ?> <?php echo 'User';?>
      <?php } else { ?><?php echo 'Users';?><?php }?></a>
    </div>

    <div class="card">
      <h2>Total Number of Visitors:</h2>
      <p> <?php echo $totalVisitors; ?> <?php if ($totalVisitors <=1) { ?> <?php echo 'Visitor';?>
      <?php } else { ?><?php echo 'Visitors';?><?php }?></p>
      <a href="viewvisitor.php" class="dropdown-item">View <?php if ($totalVisitors <=1) { ?> <?php echo 'Visitor';?>
      <?php } else { ?><?php echo 'Visitors';?><?php }?></a>
    </div>

    <div class="card">
      <h2>Total Number of Visits:</h2>
      <p> <?php echo $totalVisits; ?> <?php if ($totalVisits <=1) { ?> <?php echo 'Visit';?>
      <?php } else { ?><?php echo 'Visits';?><?php }?></p>
      <a href="viewvisit.php" class="dropdown-item">View <?php if ($totalVisits <=1) { ?> <?php echo 'Visit';?>
      <?php } else { ?><?php echo 'Visits';?><?php }?></a>
    </div>
    </div>
 
    
    <div class="post-list">
        <h2 class="post-item">Recent Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Title</th>
                    <th>Admin</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "config.php";

                    $sql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
                            FROM posts
                            INNER JOIN admin ON posts.admin_id = admin.id
                            INNER JOIN categories ON posts.category_id = categories.id
                            ORDER BY created_at DESC
                            LIMIT 5";
                    
                    $result = mysqli_query($con, $sql);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['created_at']}</td>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['admin_name']}</td>";
                        echo "<td>{$row['category_name']}</td>";  
                        echo "<td><a href='post_info.php?id={$row['id']}' class='more-info-button'>More Info</a></td>";
                        echo "</tr>";
                    }
                    
                    mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
  </div>

<?php require('footer.php');?> 
