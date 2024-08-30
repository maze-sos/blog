<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";



$con = mysqli_connect(
    $servername, $username, $password, $dbname
);

// if ($con){
//     echo "Database is Connected";
// } else {
//     echo "Database is not COnnected";
// }

if (!$con){
    die ("Connection error: ". mysqli_connect_error());
}

?>