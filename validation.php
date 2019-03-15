<?php
session_start();


$con=mysqli_connect('localhost','root','bina');


mysqli_select_db($con,'test');

$username = $_POST['user'];
$pass = $_POST['password'];
$s = "select * from usertable where name ='$username'&& password = '$pass'";

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);




if($num==1){

  $_SESSION['username'] = $username;
  //  $_SESSION['total'] = $temp;
  $_SESSION['idarray'] = array();
 header('location:home.php');

}else{
    header('location:login.php');

}

?>
