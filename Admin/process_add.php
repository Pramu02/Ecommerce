<?php
include('conn/config.php');
extract($_POST);
$uploaddir = 'news_images/';
$uploadfile = $uploaddir . basename($_FILES['attachment']['name']);
move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile);
$flname = "news_images/" . basename($_FILES["attachment"]["name"]);
mysqli_query($conn, "insert into  product values(NULL,'$name','$price','$flname')");
$_SESSION['add'] = 1;
header('location:add_product.php');