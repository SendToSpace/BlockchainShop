
<?php
session_start();
if(!isset($_SESSION['username'])){header('location:login.php');}
?>
<html>
<head>
    <title>Block Chain</title>
    <link rel="stylesheet" type="text/css" href="movingbackground.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script scr="./node_modules/web3/dist/web3.min.js"></script>


    </head>
<body>

    <a class="float-sm-right" href="logout.php"><p class="text-dark">Logout</p></a>


          <h1>Welcome To AnimateMarkt! <br>Login As <?php echo $_SESSION['username']; ?></h1>
          <h4>Token Balance Below<h4>
    </body>

    <script>
    </script>
</html>
<?php
//Above is introduction page################################################################################3
 $connect = mysqli_connect("localhost", "root", "bina", "test");
 if(isset($_POST["add_to_cart"]))
 {
      if(isset($_SESSION["shopping_cart"]))
      {
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
           if(!in_array($_GET["id"], $item_array_id))
           {
             array_push($_SESSION['idarray'],$_GET["id"]);
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                     'item_id'               =>     $_GET["id"],
                     'item_name'               =>     $_POST["hidden_name"],
                     'item_price'          =>     $_POST["hidden_price"],
                     'item_quantity'          =>     $_POST["quantity"]
                );
            $_SESSION["shopping_cart"][$count] = $item_array;
          }

           else
           {
                echo '<script>alert("Item Already Added")</script>';
                echo '<script>window.location="home.php"</script>';
           }
      }
      else
      {
           $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
           );
           $_SESSION["shopping_cart"][0] = $item_array;
      }
 }
 if(isset($_GET["action"]))
 {
      if($_GET["action"] == "delete")
      {
           foreach($_SESSION["shopping_cart"] as $keys => $values)
           {
                if($values["item_id"] == $_GET["id"])
                {
                     unset($_SESSION["shopping_cart"][$keys]);
                     echo '<script>window.location="home.php"</script>';
                }
           }
      }

}
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Block Chain Shopping Cart</title>

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
             <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
           <script scr="./node_modules/web3/dist/web3.min.js"></script>
           <link rel="stylesheet" type="text/css" href="home.css">
      </head>
      <body>
          <h2 id="balance"></h2>
          <label for="name" class="col-lg-2 control-label">Register User</label>
       <!--<input id="input" type="text">-->
         <button id="button">Register</button>
         <button id="updatebalance">UpdateBalance</button>
         <input id="input" type="text">
         <button id="button-token">Deposit</button>
        <script>

          if(typeof web3 !== 'undefined'){
            web3 = new Web3(web3.currentProvider);
          }else{
          /*  web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));*/
          web3 = new Web3(new Web3.providers.HttpProvider("http://127.0.0.1:8545"));
          }

          web3.eth.defaultAccount = web3.eth.accounts[0];

          var tradeContract = web3.eth.contract([
	{
		"constant": false,
		"inputs": [
			{
				"name": "_owneraddress",
				"type": "address"
			},
			{
				"name": "_price",
				"type": "uint256"
			},
			{
				"name": "_itemId",
				"type": "uint256"
			}
		],
		"name": "settlePayment",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [],
		"name": "register",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_itemId",
				"type": "uint256"
			},
			{
				"name": "_owner",
				"type": "string"
			},
			{
				"name": "_price",
				"type": "uint256"
			}
		],
		"name": "sell",
		"outputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "viewTokenOwn",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "user",
				"type": "address"
			}
		],
		"name": "unregister",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_itemId",
				"type": "uint256"
			}
		],
		"name": "buy",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "account",
				"type": "address"
			}
		],
		"name": "deposit",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "sender",
				"type": "address"
			},
			{
				"indexed": false,
				"name": "itemId",
				"type": "uint256"
			},
			{
				"indexed": false,
				"name": "owner",
				"type": "string"
			},
			{
				"indexed": false,
				"name": "price",
				"type": "uint256"
			}
		],
		"name": "Newitem",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "itemiId",
				"type": "uint256"
			},
			{
				"indexed": false,
				"name": "seller",
				"type": "address"
			},
			{
				"indexed": false,
				"name": "buyer",
				"type": "address"
			}
		],
		"name": "itemSold",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "tokenamount",
				"type": "uint256"
			}
		],
		"name": "NewUser",
		"type": "event"
	}
]);


var trade = tradeContract.at('0x8708f5861e62e9d1b1ffe6baa0d029ff64d87062');
console.log(trade);

var updatetoken = trade.NewUser();


updatetoken.watch(function(error, result){
          if(!error)
              {  $("#balance").html(result.args.tokenamount.toString());
                  console.log(result);
              }
          else
                    console.error(error);
      });
/*trade.viewTokenOwn(function(error, result){
          if(!error)
              {  $("#balance").html(result.toString());
                  console.log(result);
              }
          else
                    console.error(error);
      });*/

/*trade.test(function(error, result){
          if(!error)
              {
                  $("#balance").html(result);
                  console.log(result);
              }
          else
              console.error(error);
      });*/

    /*  $("#button").click(function() {
         trade.test($("#input").val(), function(error, result){
   if(!error)
       console.log(result);

   else
       console.error(error);
});*/


$("#button").click(function() {
   trade.register(function(error, result){
if(!error)
 console.log(result);

else
 console.error(error);
});

     });

     $("#updatebalance").click(function() {
       trade.viewTokenOwn(function(error, result){
                 if(!error)
                     {  $("#balance").html(result.toString());
                         console.log(result);
                     }
                 else
                           console.error(error);
             });

          });



     $("#button-token").click(function() {
        trade.deposit($("#input").val(),function(error, result){
     if(!error)
      console.log(result);

     else
      console.error(error);
     });

          });
          </script>
           <br />
           <div class="container" style="width:700px;">
                <h3 align="center">Items Cart</h3><br />
                <?php
                $query = "SELECT * FROM tbl_product ORDER BY id ASC";
                $result = mysqli_query($connect, $query);
                if(mysqli_num_rows($result) > 0)
                {
                     while($row = mysqli_fetch_array($result))
                     {
                ?>
                <div class="col-md-4">
                     <form method="post" action="home.php?action=add&id=<?php echo $row["id"]; ?>">
                          <div style="border:1px inset #123; background-color:#f198ff; border-radius:15px 50px 30px; padding:16px;" align="center">
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
                               <h4 class="text-dark"><?php echo $row["owner"]; ?></h4>
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
                               <input type="text" name="quantity" class="form-control" value="1" />
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-light" value="Add to Cart" />
                          </div>
                     </form>
                </div>
                <?php
                     }
                }
                ?>
                <div style="clear:both"></div>
                <br />
                <div class="moving-box"> <h3>Order Details</h3>
                <div class="table-responsive">
                     <table class="table table-striped table-dark">
                          <tr>
                               <th width="40%">Item Name</th>
                               <th width="10%">Quantity</th>
                               <th width="20%">Price</th>
                               <th width="15%">Total</th>
                               <th width="5%">Remove</th>
                          </tr>
                          <?php
                          if(!empty($_SESSION["shopping_cart"]))
                          {
                               $total = 0;
                               foreach($_SESSION["shopping_cart"] as $keys => $values)
                               {
                          ?>
                          <tr>
                               <td><?php echo $values["item_name"]; ?></td>
                               <td><?php echo $values["item_quantity"]; ?></td>
                               <td>$ <?php echo $values["item_price"]; ?></td>
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                               <td><a href="home.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>

                          </tr>
                          <?php
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                               }
                          ?>
                          <tr>
                               <td colspan="3" align="right">Total</td>
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>
                               <td><a href="checkout.php?action=checkout"><span class="text-primay">Check Out</span></a></td>
                               <td></td>
                          </tr>
                          <?php
                          }
                          ?>
                    </table>   </div>
                </div>
           </div>
           <br />
      </body>
     <!---upload--->


     <form enctype="multipart/form-data"
action="add.php" method="POST">
         <div class="container">
             <h1>Got a Animate to sell?</h1>
              <div class="add-product">
name: <input type="text" name="name"><br>
price: <input type="text" name = "price"><br>
image: <input type="file" name="image"><br>
                  <input type="submit" value="Add a Animate"></div> </div>  </form>


       <form enctype="multipart/form-data"
action="del.php" method="POST">
         <div class="container">
             <h1>Remove Product</h1>
              <div class="remove-product">
id: <input type="text" name="id"><br>
                  <input type="submit" value="remove"></div> </div>  </form>


 </html>
