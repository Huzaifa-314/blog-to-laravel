<?php
//database credential
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// include 'include/function.php';
$BLOG_PAGE_URL = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$BASE_URL=$_SERVER['HTTP_HOST'];
?>
