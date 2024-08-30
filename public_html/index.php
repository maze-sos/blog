<?php
require_once "config.php";

$ipAddress = $_SERVER['REMOTE_ADDR'];


$sqlInsertVisits = "INSERT INTO visits (ip_address) VALUES ('$ipAddress')";



$sqlCheckIp = "SELECT COUNT(*) AS ip_count FROM visitors WHERE ip_address = '$ipAddress'";
$resultCheckIp = mysqli_query($con, $sqlCheckIp);
$rowCheckIp = mysqli_fetch_assoc($resultCheckIp);
$ipCount = $rowCheckIp['ip_count'];

if ($ipCount == 0) {

    $sqlInsertVisitor = "INSERT INTO visitors (ip_address) VALUES ('$ipAddress')";
}

$latestCategorySql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
    FROM posts
    INNER JOIN admin ON posts.admin_id = admin.id
    INNER JOIN categories ON posts.category_id = categories.id
    WHERE posts.category_id = 4
    ORDER BY created_at DESC
    LIMIT 3";


$latestCategoryResult = mysqli_query($con, $latestCategorySql);

$latestCategoryPosts = mysqli_fetch_all($latestCategoryResult, MYSQLI_ASSOC);

$sql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
        FROM posts
        INNER JOIN admin ON posts.admin_id = admin.id
        INNER JOIN categories ON posts.category_id = categories.id
        ORDER BY created_at DESC
        LIMIT 5";


$result = mysqli_query($con, $sql);


$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$latestSql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
            FROM posts
            INNER JOIN admin ON posts.admin_id = admin.id
            INNER JOIN categories ON posts.category_id = categories.id
            ORDER BY created_at DESC
            LIMIT 1";

$latestResult = mysqli_query($con, $latestSql);
$latestPost = mysqli_fetch_assoc($latestResult);


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
    <header class="page-header"></header>
    <!-- end of page header -->

    <div class="container">
        <section>
        <div class="feature-posts">
        <a href="single-post.html" class="feature-post-item">                       
        <span>Featured Posts for Lincoln</span>
        </a>
        <?php foreach ($latestCategoryPosts as $latestCategoryPost) : ?>
        <a href='single-post.php?id=<?php echo htmlspecialchars($latestCategoryPost['id']) ?>&category=<?php echo htmlspecialchars($latestCategoryPost['category_id']); ?>' class="feature-post-item">
            <img src="../admin/<?php echo htmlspecialchars($latestCategoryPost['postpic']); ?>" class="w-100" alt="" style="height: 300px;">
            <div class="feature-post-caption"><?php echo htmlspecialchars($latestCategoryPost['title']); ?></div>
        </a>
    <?php endforeach; ?>
            </div>
        </section>
        <hr>
        <div class="page-container">
            <div class="page-content">
                    <?php if (!empty($latestPost)) : ?>
                    <div class="card mb-5">
                        <div class="card-header text-center">
                            <h5 class="card-title">Latest Post</h5>
                            <small class="small text-muted"><?php echo htmlspecialchars($latestPost['created_at']); ?></small>
                        </div>
                        <div class="card-body">
                            <div class="blog-media">
                                <img src="../admin/<?php echo htmlspecialchars($latestPost['postpic']); ?>" alt="" class="w-100" style="height: 1000px;">
                                <a href="#" class="badge badge-primary">#<?php echo htmlspecialchars($latestPost['category_name']); ?></a>
                            </div>
                            <p class="my-3"><?php echo htmlspecialchars($latestPost['content']); ?></p>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center flex-basis-0">
                            <button class="btn btn-primary circle-35 mr-4"><i class="ti-back-right"></i></button>
                            <a href='single-post.php?id=<?php echo htmlspecialchars($latestPost['id']) ?>&category=<?php echo htmlspecialchars($latestPost['category_id']); ?>' class="btn btn-outline-dark btn-sm">READ MORE</a>
                            <a href="#" class="text-dark small text-muted">By: <?php echo htmlspecialchars($latestPost['admin_name']); ?></a>
                        </div>
                    </div>
                    <hr>
                <?php endif; ?>
                <hr>
                
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
                                <a href='single-post.php?id=<?php echo htmlspecialchars($post['id']) ?>&&category=<?php  echo htmlspecialchars($post['category_id']); ?>' class="btn btn-outline-dark btn-sm">READ MORE</a>
                            </div>                  
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
                <a href="loadpost.php" class="btn btn-primary btn-block my-4">Load More Posts</a>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php');?>