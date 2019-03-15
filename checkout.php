<?php
include 'home.php';
//session_start();
$username = $_SESSION['username'];

$con=mysqli_connect("localhost","root","bina","test") or die('no server connected');
mysqli_select_db(mysqli_connect("localhost","root","bina"),"test") or die(mysqli_error("not work"));



var_dump($_SESSION['idarray']);
foreach ($_SESSION['idarray'] as &$value) {
$pia = mysqli_query($con,"SELECT `price`, `id`,`address` FROM `tbl_product` WHERE `id`  = $value");
$result = mysqli_fetch_array($pia);
echo  '<script>
var id =' . json_encode($result[1]) . ';
var price =' . json_encode($result[0]) . ';
var address =' . json_encode($result[2]) . ';

trade.settlePayment(address,price,id,function(error, result){
if(!error){
  console.log(result);
}
else
 console.error(error);

});</script>';

echo $result[0];
echo $result[1];
echo $result[2];
$update=mysqli_query($con,"UPDATE `tbl_product` SET `owner` = '$username' WHERE `tbl_product`.`id` = $value") or die('Not updated');
unset($_SESSION["shopping_cart"][$value]);
unset($_SESSION['idarray'][$value]);
}



echo '<script>window.location="home.php"';
?>
