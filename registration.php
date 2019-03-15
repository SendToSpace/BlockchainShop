<?php
session_start();
header('location:login.php');

$con=mysqli_connect('localhost','root','bina'); 


mysqli_select_db($con,'test');

$name = $_POST['user'];
$pass = $_POST['password'];
$s = "select * from usertable where name ='$name'";

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num==1){
    echo"Repeated Usernames";
}else{
    
    $reg= " insert into usertable(name, password,lolita) values ('$name','$pass','23333.33')";
    mysqli_query($con, $reg);
    echo"Successful";
}

?>