
<style>
    nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: black;
    color: rgb(194, 246, 234);
    padding: 1rem;
  }
  
ul {
    list-style: none;
    display: flex;
  }
.welcome {
    font-size: large;
    color: black;
    background-color: rgb(194, 246, 234);
    padding: 0px 5px 0px 5px;
    border-radius: 3px;
}

ul li {
    margin-right: 3rem;
    cursor: pointer;
  }

ul li a {
    color: inherit;
    text-decoration: inherit;
}

ul li::after{
    content: '';
    width: 0%;
    height: 2px;
    background: rgb(194, 246, 234);
    display: block;
    margin: auto;
    transition: 0.5s;
}

ul li:hover::after{
    width: 100%;
}
</style>

<nav >
    <div class="container">
        
        <ul>

            <?php if(isset($_SESSION['admin_login'])) { 
            $name = $_SESSION['admin_login'];?>
            <li class="welcome"><a href="">Welcome, <?php  echo htmlspecialchars($name); ?></a></li>
            <li><a href="index.php">Admin Dashboard</a></li>
            <li><a href="logout.php">Admin logout</a></li> 

            <?php } else {?>
            <li><a href="../public_html/index.php">Back to Public Page</a></li> 
            <li><a href="login.php">Admin Log In</a></li>
            <li><a href="signup.php">Admin Sign Up</a></li>
            
            <?php }?>
           
        </ul> 
    </div>
</nav>