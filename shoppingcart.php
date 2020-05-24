<!doctype html>
<html lang="en">
<?php session_start();
	$refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
                            $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
							
	if (!empty($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	}
	if(!$refreshButtonPressed){
		$id = $_GET['productid'];
		$name = $_GET['productname'];
		$price = $_GET['productprice'];
		$qty = 1;
	
	
		$itemExists = 0;

			if (!empty($cart)) {
				foreach ($cart as $cartKey => $cartItem) {
				  if ($cartItem['pid'] == $id) {
					$itemExists = 1;
					$cartItem['qty'] = $cartItem['qty'] + 1;
				  } 
				  $total = $cartItem['qty'] * $cartItem['price'];
				  $tempCartItem = array(
					"pid" => $cartItem['pid'],
					"qty" => $cartItem['qty'],
					"name" => $cartItem['name'],
					"price" => $cartItem['price'],
					"total" => $total
				  );  
				// add the item to the temporary cart
				$tempCart[] = $tempCartItem;
				}
				$_SESSION['cart'] = $tempCart;
			}
			if ($itemExists == 0) {
			  $total = $qty * $price;
			  $cartItem = array(
			  "pid" => $id,
			  "qty" => $qty,
			  "name" => $name,
			  "price" => $price,
			  "total" => $total);
			  // add the item to the cart
			  $cart[] = $cartItem;
			  $_SESSION['cart'] = $cart;
			}


	}
	
	

	
	
	?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="./css/customerinfo.css">
    <title>Shopping Cart</title>
  </head>
  <body>
  <div class="container">
    <h1 style="margin-top: 2.5em;">Shopping Cart</h1>
	
		<div class="container">
	  <table class="table table-sm table-dark table-striped table-bordered">
		<thead>
		<th>Product Code</th>
		<th>Product Name</th>
		<th style="align: right">Price</th>
		<th>Quantity </th>
		<th style="align: right">Total</th>
		</thead>
		<tbody>
	 <?php
	  $billTotal = 0;
	  foreach ($cart as $cartKey => $cartItem) {
		$id = $cartItem['pid'];
		$name = $cartItem['name'];
		$price = $cartItem['price'];
		$qty = $cartItem['qty'];
		$strPrice = "$".number_format($price, 2, '.', '');  $total = $cartItem['total'];
		$strItemTotal = "$".number_format($total, 2, '.', '');
		echo "<tr>";
		echo "<td>$id</td>";
		echo "<td>$name</td>";
		echo "<td>$strPrice</td>";
		echo "<td>$qty</td>";
		echo "<td align='right'>$strItemTotal</td>";
		echo "</tr>";
		$billTotal = $billTotal + $total;
	  }
	  $billTotal = $billTotal + ($billTotal * .07);
	  $strBillTotal = "$".number_format($billTotal, 2, '.', '');
	  echo "<tr><td colspan='4' align='right'> Bill Total</td><td align='right'>$strBillTotal</td></tr>"
	?>
	</tbody>
	</table>

	<a href="<?php echo 'custinfo.php?' ;?>">CHECK OUT</a>
	
		</div>
	
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>