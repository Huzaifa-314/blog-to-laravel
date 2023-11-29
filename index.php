<?php 
include 'load/load.php';
include 'include/function.php';
if(isset($_GET['category'])){
    $category_id = $_GET['category'];
    $sql = "SELECT * FROM tbl_post where cat = $category_id";
    $result = mysqli_query($conn, $sql);
}else{
    $sql = "SELECT * FROM tbl_post";
    $result = mysqli_query($conn, $sql);
}


// echo $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/all.css">
    <link rel="stylesheet" href="assets/blog.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <title>Library Literal Blog</title>
</head>
<body>
    <!-- Your content goes here -->

    <!-- Preloader -->
    <!-- <div id="preloader"></div> -->
    

    <div class="container mt-100 mt-60">
        <div class="row">

        <?php 
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
            <div class="col-lg-3 col-md-6 mt-4 pt-2">
                <div class="blog-post rounded">
                    <div class="blog-img d-block overflow-hidden position-relative">
                        <img src="<?php echo 'media/'.$image_name.''?>" class="img-fluid rounded-top" alt="">
                        <a href="single-blog.php?id=<?php echo $id?>" class="cursor-pointer"><div class="overlay rounded-top bg-dark cursor-pointer"></div></a> 
                    </div>
                    <div class="content">
                        <small class="text-muted p float-right"><?php echo $date->format('M j, Y');?></small> / 
                        <small><a href="index.php?category=<?php echo $cat_id;?>" class="text-primary"><?php echo findval($conn,'name','tbl_category','id',$cat_id) ?></a></small>
                        <h4 class="mt-1 "><a href="single-blog.php?id=<?php echo $id?>" class="text-dark title"><?php echo $title?></a></h4>
                        <p class="text-muted mt-2 small"><?php echo $excerpt?></p>
                        <div class="post-extra pt-1 p-1 border-top d-flex w-100 justify-content-between">
                                <div class="author">
                                    <h6 class="mt-1 mb-0"><a href="javascript:void(0)" class="text-dark name"><small>by </small><?php echo $author_name?></a></h6>
                                </div>
                                <!-- Share Buttons -->
                                <div class="">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="share-icon" id="facebook-share"><i class="fa-brands fa-facebook"></i></a>
                                    <!-- <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?> class="share-icon" id="instagram-share"><i class="fab fa-instagram"></i></a> -->
                                    <a href="http://twitter.com/intent/tweet/?url=<?php echo $BLOG_PAGE_URL.'single-blog.php?id='.$id ?>" class="share-icon" id="twitter-share"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="hover-icon" id="hover-share"><i class="fa-solid fa-share-nodes fa-rotate-180"></i></a>
                                </div>  
                        </div>
                    </div>
                </div><!--end blog post-->
            </div><!--end col-->
        <?php 
            }
        } else {
            echo "No posts found.";
        }
        ?>
            

            
        </div><!--end row-->
    </div>
    

    <!-- Your scripts go here -->
    <script src="assets/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
