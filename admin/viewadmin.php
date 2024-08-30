<?php session_start();
 require('header.php');?> 
<title>View Admins</title>
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

        .admin-list {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin: 10rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        h2{
            color: rgb(194, 246, 234);
        }
        th {
            padding: 12px;
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
<div class="body">
    <div class="admin-list">
        <h2>Admin List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "config.php";

                    $sql = "SELECT * FROM admin";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td><a href='admin_info.php?id={$row['id']}' class='more-info-button'>More Info</a></td>";
                        echo "</tr>";
                    }

                    mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</div>    
<?php require('footer.php');?> 