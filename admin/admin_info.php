<?php session_start();
require('header.php');?> 
<title>Admin Info</title>
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

        .admin-info-container {
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

        .admin-details {
            margin-top: 20px;
        }

        .admin-details p {
            margin-bottom: 10px;
        }

        .admin-profile-pic {
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
<div class="admin-info-container">
        <h2>Admin Information</h2>
        <div class="admin-details">
            <?php
                require_once "config.php";

                if (isset($_GET['id'])) {
                    $adminId = mysqli_real_escape_string($con, $_GET['id']);

                    $sql = "SELECT * FROM admin WHERE id = '$adminId'";
                    $result = mysqli_query($con, $sql);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $profilePic = empty($row['profile_pic']) ? 'default-profile-pic.jpg' : $row['profile_pic'];
                        echo "<img src='{$profilePic}' alt='Profile Picture' class='admin-profile-pic'>";
                        echo "<p><strong>ID:</strong> {$row['id']}</p>";
                        echo "<p><strong>Name:</strong> {$row['name']}</p>";
                        echo "<p><strong>Email:</strong> {$row['email']}</p>";
                        echo "<p><strong>Created At:</strong> {$row['created_at']}</p>";
                    } else {
                        echo "<p>Admin not found</p>";
                    }
                } else {
                    echo "<p>Invalid request</p>";
                }

                mysqli_close($con);
            ?>
        </div>
        <a href="viewadmin.php" class="button">Back to Admin List</a>
        <a href="editadmin.php?&id=<?php echo htmlspecialchars($row['id']); ?> " class="button">Edit Admin</a>
    </div>
</div>    
<?php require('footer.php');?> 