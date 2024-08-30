<?php session_start();
require_once "config.php";
if (isset($_GET['id'])) {
    $postId = mysqli_real_escape_string($con, $_GET['id']);

    $sql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
    FROM posts
    INNER JOIN admin ON posts.admin_id = admin.id
    INNER JOIN categories ON posts.category_id = categories.id
    WHERE posts.id = '$postId'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);

   } else {
    echo "<p>Invalid request</p>";
   }

if (isset($row['category_name'])) {
        $postCat = mysqli_real_escape_string($con, $row['category_name']);
        $relsql = "SELECT posts.*, admin.name AS admin_name, categories.category AS category_name
        FROM posts
        INNER JOIN admin ON posts.admin_id = admin.id
        INNER JOIN categories ON posts.category_id = categories.id
        WHERE posts.category_id = (SELECT id FROM categories WHERE category = '$postCat')
        AND posts.id != '$postId' 
        ORDER BY created_at DESC
        LIMIT 3";

    $relresult = mysqli_query($con, $relsql);


    $relposts = mysqli_fetch_all($relresult, MYSQLI_ASSOC);
}

?> 
<?php require('header.php');?>
    <title>Lincoln Student Blog website</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + JoeBLog main styles -->
	<link rel="stylesheet" href="assets/css/joeblog.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    
    <!-- Page Second Navigation -->
<?php require('nav.php');?>
    <!-- End Of Page Second Navigation -->

    <!-- Page Header -->
    <header class="page-header page-header-mini">
        <h1 class="title"><?php echo htmlspecialchars ($row['title']); ?></h1>
        <ol class="breadcrumb pb-0">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">By : <?php  echo htmlspecialchars($row['admin_name']); ?></li>
        </ol>
    </header>
    <!-- End Of Page Header -->

    <section class="container">
        <div class="page-container">
            <div class="page-content">
                <div class="card">
                    <div class="card-header pt-0">
                        <h3 class="card-title mb-4"><?php echo htmlspecialchars ($row['title']); ?></h3>
                        <div class="blog-media mb-4">
                            <img src="../admin/<?php echo htmlspecialchars($row['postpic']); ?>" alt="" class="w-100">
                            <a href="#" class="badge badge-primary">#<?php  echo htmlspecialchars($row['category_name']); ?></a> 
                        </div>  
                        <small class="small text-muted">
                            <a href="#" class="text-muted">By: <?php  echo htmlspecialchars($row['admin_name']); ?></a>
                            <span class="px-2">·</span>
                            <span><?php  echo htmlspecialchars($row['created_at']); ?></span>
                            <span class="px-2">·</span>
                            <a href="#" class="text-muted">32 Comments</a>
                        </small>
                    </div>
                    <div class="card-body border-top">
                        <p class="my-3"><?php  echo htmlspecialchars($row['content']); ?></p>
                    </div>
                    
                    <div class="card-footer">
                         <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments 4</a></h6>
                        <hr>
                        <div class="media">
                            <img src="assets/imgs/avatar-1.jpg" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Janice Wilder</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a>
                                <div class="media mt-5">
                                    <a class="mr-3" href="#">
                                    <img src="assets/imgs/avatar.jpg" class="thumb-sm rounded-circle" alt="...">
                                    </a>
                                    <div class="media-body align-items-center">
                                        <h6 class="mt-0">Joe Mitchell</h6>
                                        <p>Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus</p>
                                        <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media mt-5">
                            <img src="assets/imgs/avatar-2.jpg" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Crosby Meadows</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a>
                            </div>
                        </div>
                        <div class="media mt-4">
                            <img src="assets/imgs/avatar-3.jpg" class="mr-3 thumb-sm rounded-circle" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Jean Wiley</h6>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a>
                            </div>
                        </div>

                        <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Write Your Comment</a></h6>
                        <hr>
                        <form>
                            <div class="form-row">
                                <div class="col-12 form-group">
                                    <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Enter Your Comment Here"></textarea>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="text" class="form-control" value="Name">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="url" class="form-control" placeholder="Website">
                                </div>
                                <div class="form-group col-12">
                                    <button class="btn btn-primary btn-block">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>                  
                </div> 
               
                <h6 class="mt-5 text-center">Related Posts</h6>
                <hr>
                <div class="row">  
                <?php foreach ($relposts as $relpost) : ?>                       
                    <div class="col-md-6 col-lg-4">
                        <div class="card mb-5">
                            <div class="card-header p-0">                                   
                                <div class="blog-media">
                                    <img src="../admin/<?php echo htmlspecialchars($relpost['postpic']); ?>" alt="" style="height: 200px; width: 200px">
                                    <a href="#" class="badge badge-primary">#<?php  echo htmlspecialchars($relpost['category_name']); ?></a>        
                                </div>  
                            </div>
                            <div class="card-body px-0">
                                <h6 class="card-title mb-2"><a href="#" class="text-dark"><?php  echo htmlspecialchars($relpost['title']); ?></a></h6>  
                                <small class="small text-muted"><?php  echo htmlspecialchars($relpost['created_at']); ?>
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-dark small text-muted">By : <?php  echo htmlspecialchars($relpost['admin_name']); ?></a>
                                </small>
                            </div>                  
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
            <!-- Sidebar -->
            <div class="page-sidebar">
                <h6 class=" ">Tags</h6>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#iusto</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#quibusdam</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#officia</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#animi</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#mollitia</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#quod</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#ipsa at</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#dolor</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#incidunt</a>
                <a href="javascript:void(0)" class="badge badge-primary m-1">#possimus</a>
    
                <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div>
            </div>
        </div>
    </section>

<?php require('footer.php');?>