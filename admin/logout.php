<?php 
session_start();
unset($_SESSION['admin_login']);
session_destroy();
header("location: login.php");
?>