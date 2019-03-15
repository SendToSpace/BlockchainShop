
<?php
include 'home.php';
/*session_start*/
$target = "";
$target = $target . basename( $_FILES['image']['name']);
//$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$image=($_FILES['image']['name']);
$seller=$_SESSION['username'];
$address = "0";

$con=mysqli_connect("localhost","root","bina","test") or die('no server connected');
mysqli_select_db(mysqli_connect("localhost","root","bina"),"test") or die(mysqli_error());





echo  '<script type="text/javascript">
var seller = "<?php echo $seller ?>";
var cost = ' . json_encode($price) . ';
trade.sell(0,seller,cost,function(error, result){
if(!error){
 console.log(result);
}
else
 console.error(error);
});</script>';

echo  '<script type="text/javascript">
var getaddress = trade.Newitem();
var address;
getaddress.watch(function(error, result){
         if(!error){
           console.log(result);
               $("#balance").html(result.args.sender.toString());
                result = result.args.sender.toString();
                  document.cookie = "result = " + result;

             }
         else
                   console.error(error);
     });

</script>;';

$address =$_COOKIE['result'];

$insert=mysqli_query($con,"INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`, `owner`,`address`) VALUES (NULL, '$name', '$image', '$price', '$seller','$address');") or die('Data not inserted, clients');

move_uploaded_file($_FILES['image']['tmp_name'],$target);

if($insert)
{  } else{echo "bad";}

?>
