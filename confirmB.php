<!DOCTYPE html>
<html>
<head>
<?php session_start();
	$refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
                            $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
							
	if (!empty($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	}
	?>
<title>Review Order</title>
<link rel="stylesheet" href="./css/customerinfo.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>


 <body>

 <?php 
 ?>
  <div class="container">
    <h1 style="margin-top: 2.5em;">Confirm</h1>
	
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

		$itemTotal = $price * $qty;
		echo "<tr>";
		echo "<td>$id</td>";
		echo "<td>$name</td>";
		echo "<td>$price</td>";
		echo "<td>$qty</td>";
		echo "<td align='right'>$itemTotal</td>";
		echo "</tr>";
		$billTotal = $billTotal + $itemTotal;
	  }

	  $tax = round($billTotal * .07, 2);
	  $shipping = 0;
	  if($_POST["ShippingMethod"] == "2-Day") {
		  $shipping = 14.99;
	  } else if($_POST["ShippingMethod"] == "1-Day") {
		  $shipping = 19.99;
	  } else if($_POST["ShippingMethod"] == "Overnight") {
		  $shipping = 24.99;
	  }

	  $total = $billTotal + $shipping + $tax;

	  echo "<tr><td colspan='4' align='right'> Sub Total</td><td align='right'>$billTotal</td></tr>";
 	  echo "<tr><td colspan='4' align='right'> Tax </td><td align='right'>$tax</td></tr>";
	  echo "<tr><td colspan='4' align='right'> Shipping </td><td align='right'>$shipping</td></tr>";
	  echo "<tr><td colspan='4' align='right'> Total </td><td align='right'>$total</td></tr>";
	
	?>
	</tbody>
	</table>








<body>
<table class="table table-sm table-dark table-striped table-bordered">

<td>

<h1>
Billing Information:
</h1>

First Name: <?php echo $_POST["BillingFirst"]; ?><br>

</body>
<body>

Last Name: <?php echo $_POST["BillingLast"]; ?><br>

</body>
<body>

Street Address: <?php echo $_POST["BillingAddress"]; ?><br>

</body>
<body>

City: <?php echo $_POST["BillingCity"]; ?><br>

</body>
<body>

State: <?php echo $_POST["BillingState"]; ?><br>

</body>
<body>

Zip: <?php echo $_POST["BillingZip"]; ?><br>

</body>
<body>

Email: <?php echo $_POST["BillingEmail"]; ?><br>

</body>

<h1>
Shipping Information:
</h1>
<body>

Send Brochure: <?php
	if (isset($_POST['ShippingCheckbox'])){
		echo 'Yes'; 
	}
	else {
		echo 'No';
	}
	?><br>

</body>
<body>

First Name: <?php echo $_POST["ShippingFirst"]; ?><br>

</body>
<body>

Last Name: <?php echo $_POST["ShippingLast"]; ?><br>

</body>
<body>

Street Address: <?php echo $_POST["ShippingAddress"]; ?><br>

</body>
<body>

City: <?php echo $_POST["ShippingCity"]; ?><br>

</body>
<body>

State: <?php echo $_POST["ShippingState"]; ?><br>

</body>
<body>

Zip: <?php echo $_POST["ShippingZip"]; ?><br>

</body>
<body>

Email: <?php echo $_POST["ShippingEmail"]; ?><br>

</body>
<h1>
Shipping Method:
</h1>
<body>
<?php
if(isset($_POST['ShippingMethod'])){
$ship_val = $_POST['ShippingMethod']; 
echo "Method: " .$ship_val;
}
?><br>

</body>
<h1>
Payment Details
</h1>
<body>
<?php
if(isset($_POST['PaymentCardType'])){
$pay_val = $_POST['PaymentCardType']; 
echo "Card Type: " .$pay_val;
}

//session_abort();
?><br>

</body>
<body>

Card Number: <?php echo $_POST["PaymentCreditCard"]; ?><br>

</body>
<body>

Expiration Date: <?php echo $_POST["PaymentExpiration"]; ?><br>

</table>

<a href=" ./thankyou.php">Confirm Order</a>
</body>
</html>
