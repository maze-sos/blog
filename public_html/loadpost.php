<?php
require_once "config.php";

$sql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
FROM posts
INNER JOIN admin ON posts.admin_id = admin.id
INNER JOIN categories ON posts.category_id = categories.id"
;


$result = mysqli_query($con, $sql);


$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);
?>
<?php require('header.php');?>
    <title>Lincoln Student Blog website</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + main styles -->
	<link rel="stylesheet" href="assets/css/joeblog.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    <!-- page First Navigation -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/imgs/linclogo.png" alt="">
            </a>
            <div class="socials">
                <a href="javascript:void(0)"><i class="ti-facebook"></i></a>
                <a href="javascript:void(0)"><i class="ti-twitter"></i></a>
                <a href="javascript:void(0)"><i class="ti-pinterest-alt"></i></a>
                <a href="javascript:void(0)"><i class="ti-instagram"></i></a>
                <a href="javascript:void(0)"><i class="ti-youtube"></i></a>
            </div>
        </div>
    </nav>
    <!-- End Of First Navigation -->

    <!-- Page Second Navigation -->
<?php require('nav.php');?>
    <!-- End Of Page Second Navigation -->
    
    <!-- page-header -->
    <header class="page-header">List of News</header>
    <!-- end of page header -->
<br>
<br>
<br>

    <div class="container">
        <div class="page-container">
        <div class="row">    
                <?php foreach ($posts as $post) : ?>                   
                    <div class="col-lg-6">
                        <div class="card text-center mb-5">
                            <div class="card-header p-0">                                   
                                <div class="blog-media">
                                    <img src="../admin/<?php echo htmlspecialchars($post['postpic']); ?>" alt="" class="w-100" style="height: 500px;">
                                    <a href="#" class="badge badge-primary">#<?php  echo htmlspecialchars($post['category_name']); ?></a>        
                                </div>  
                            </div>
                            <div class="card-body px-0">
                                <h5 class="card-title mb-2"><?php  echo htmlspecialchars($post['title']); ?></h5>    
                                <small class="small text-muted"><?php  echo htmlspecialchars($post['created_at']); ?>
                                </small>
                                <a href="#" class="text-dark small text-muted">By : <?php  echo htmlspecialchars($post['admin_name']); ?></a>
                            </div>
                            
                            <div class="card-footer p-0 text-center">
                                <a href='single-post.php?id=<?php echo htmlspecialchars($post['id']) ?>' class="btn btn-outline-dark btn-sm">READ MORE</a>
                            </div>                  
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
        </div>
    </div>

<?php require('footer.php');?>
