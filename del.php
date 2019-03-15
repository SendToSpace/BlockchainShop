<?php
session_start();
$id=$_POST['id'];


$con=mysqli_connect("localhost","root","bina","test") or die('no server connected'); 
mysqli_select_db(mysqli_connect("localhost","root","bina"),"test") or die(mysqli_error()) ;


$del =mysqli_query($con,"DELETE FROM `tbl_product` WHERE `id` = $id;") or die ('can not del');

echo '<script>window.location="home.php"</script>';


    
?>