<?php
include 'load/load.php';
include 'include/function.php';
if(isset($_GET['id'])){
    $post_id=$_GET['id'];
    $sql = "SELECT * FROM tbl_post where id = $post_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    $cat_id = $row["cat"];
    $title = $row["title"];
    $body = $row["body"];
    $image_name = $row["image"];
    $tags = $row["tags"];
    $author_name = $row["author"];
    $date = new DateTime($row['date']);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/all.css">
    <link rel="stylesheet" href="assets/single-blog.css">
    <link rel="stylesheet" href="assets/blog.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <title>Single Blog Page</title>
</head>
<body>
    <!-- Banner at the top -->
    <div class="banner mb-5">
        <div class="overlay">
            <h1>Blog</h1>
            <div class="breadcrumb">
                <a href="<?php echo "/" ?>">Home </a>//<a href="<?php echo "/blog" ?>">blog </a> // <a href="#"> Category </a>//Blog Post
            </div>
        </div>
    </div>

    <div class="container mt-100 mt-60">
        <div class="row pt-3">
            <!-- Main Content -->
            <div class="col-lg-9 ps-5 pe-5 pt-0">
                <div class="single-blog-post rounded">
                    <!-- Blog post content goes here -->
                    <div class="featured-image">
                    <img src="<?php echo 'media/'.$image_name.''?>" class="img-fluid rounded-top" alt="">
                    </div>
                    <div class="post-meta mt-2">
                        <small class="text-muted p float-right"><?php echo $date->format('M j, Y');?></small> / 
                        <small><a href="index.php?category=<?php echo $cat_id;?>" class="text-primary"><?php echo findval($conn,'name','tbl_category','id',$cat_id) ?></a></small>
                    </div>
                    <h2 class="mt-4"><a href="single-blog.php?id=<?php echo $post_id?>" class="text-dark title"><?php echo $title?></a></h2>
                    <div class="post-main-content text-muted">
                        <?php echo $body?>
                    </div>
                    <hr>
                    <div class="post-etc">
                        <!-- Share Buttons -->
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="single-share-icon" id="facebook-share"><i class="fa-brands fa-facebook"></i></a>
                            <!-- <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?> class="single-share-icon" id="instagram-share"><i class="fab fa-instagram"></i></a> -->
                            <a href="http://twitter.com/intent/tweet/?url=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="single-share-icon" id="twitter-share"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="hover-icon" id="hover-share"><i class="fa-solid fa-share-nodes fa-rotate-180"></i></a>
                        </div>
                        <div class="like-comment">

                        </div>
                    </div>

                    <div class="related-post">
                        <div class="row">
                            <?php
                                $r_sql = "SELECT * FROM tbl_post WHERE cat = $cat_id AND id <> $post_id";
                                $r_result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row["id"];
                                        $cat_id = $row["cat"];
                                        $title = $row["title"];
                                        $excerpt = $row['excerpt'];
                                        $image_name = $row["image"];
                                        $author_name = $row["author"];
                                        $date = new DateTime($row['date']);
                                    ?>
                                    <!-- post start -->
                                    <div class="col-md-4 mt-4 pt-2">
                                        <div class="blog-post rounded">
                                            <div class="blog-img d-block overflow-hidden position-relative">
                                                <img src="<?php echo 'media/'.$image_name.''?>" class="img-fluid rounded-top" alt="">
                                                <a href="single-blog.php?id=<?php echo $id?>" class="cursor-pointer"><div class="overlay rounded-top bg-dark cursor-pointer"></div></a> 
                                            </div>
                                            <div class="content">
                                                <small class="text-muted p float-right"><?php echo $date->format('M j, Y');?></small> / 
                                                <small><a href="#" class="text-primary"><?php echo findval($conn,'name','tbl_category','id',$cat_id) ?></a></small>
                                                <h4 class="mt-1 "><a href="single-blog.php?id=<?php echo $id?>" class="text-dark title"><?php echo $title?></a></h4>
                                                <!-- <p class="text-muted mt-2 small"><?php echo $excerpt?></p>
                                                <div class="post-extra pt-1 p-1 border-top d-flex w-100 justify-content-between">
                                                        <div class="author">
                                                            <h6 class="mt-1 mb-0"><a href="javascript:void(0)" class="text-dark name"><small>by </small><?php echo $author_name?></a></h6>
                                                        </div>
                                                        
                                                        <div class="">
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="share-icon" id="facebook-share"><i class="fa-brands fa-facebook"></i></a>
                                                            <a href="http://twitter.com/intent/tweet/?url=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="share-icon" id="twitter-share"><i class="fab fa-twitter"></i></a>
                                                            <a href="#" class="hover-icon" id="hover-share"><i class="fa-solid fa-share-nodes fa-rotate-180"></i></a>
                                                        </div>  
                                                </div> -->
                                            </div>
                                        </div><!--end blog post-->
                                    </div><!--end col-->
                                    <?php 
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="previous-next d-flex justify-content-between">
                        <div class="previous">
                            
                            <?php 
                                $prev_post_id = prev_post_id($conn, $post_id);
                                $p_sql = "SELECT * FROM tbl_post where id = $prev_post_id";
                                $p_result = mysqli_query($conn, $p_sql);
                                if($p_row = mysqli_fetch_assoc($p_result)){
                                    $p_title = $p_row["title"];
                                    $p_image= $p_row['image'];
                                    ?>
                                        <div class="content d-flex">
                                        <a href="single-blog.php?id=<?php echo $prev_post_id?>"><img src="<?php echo 'media/'.$p_image.''?>" class="img-fluid rounded-top p-3" alt="" width="150px"></a>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h5>Previous</h5>
                                                <small class="text-decoration-none text-muted"><a class="text-decoration-none" href="single-blog.php?id=<?php echo $prev_post_id?>"><?php echo $p_title?></a></small>
                                            </div>
                                            

                                        </div>
                                    <?php
                                }
                                
                            ?>
                            
                        </div>
                        <div class="next">
                            
                        <?php
                                $nextId = next_post_id($conn,$post_id);
                                $n_sql = "SELECT * FROM tbl_post where id = $nextId";
                                $n_result = mysqli_query($conn, $n_sql);
                                if($n_row = mysqli_fetch_assoc($n_result)){
                                    
                                    $n_title = $n_row["title"];
                                    $n_image= $n_row['image'];
                                    ?>
                                        <div class="content d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h5 style="text-align:right;">Next</h5>
                                                <small class="text-decoration-none text-muted"><a class="text-decoration-none" href="single-blog.php?id=<?php echo $nextId?>"><?php echo $n_title?></a></small>
                                            </div>
                                            
                                            <a href="single-blog.php?id=<?php echo $nextId?>"><img src="<?php echo 'media/'.$n_image.''?>" class="img-fluid rounded-top p-3" alt="" width="150px"></a>
                                        </div>
                                    <?php
                                }
                                
                            ?>
                            
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <!-- Right Sidebar (Fixed Position) -->
            <div class="col-lg-3">
                <div class="fixed-sidebar">
                    <!-- Sidebar widget content goes here -->
                    <h2>Catagories</h2>
                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)){
                            $category_id = $row['id'];
                            $category_name = $row['name'];
                            ?>
                                <small><a class="category-name" href="index.php?category=<?php echo $category_id;?>"><?php echo $category_name; ?></a></small><br>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div><!--end row-->
    </div>

    <!-- Your scripts go here -->
    <script src="assets/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

    
    <?php
}