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
  <table class="table table-sm table-dark table-striped table-bordered">
	<tr>
	<td><h1 style="margin-top: 2.5em;">Confirm</h1></td>
	</tr>
	</table>
	</table>
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
	  $stringBillTotal = sprintf('%0.2f', $billTotal);
	  $stringTax = sprintf('%0.2f', $tax);
	  $stringShipping = sprintf('%0.2f', $shipping);
	  $stringTotal = sprintf('%0.2f', $total);

	  echo "<tr><td colspan='4' align='right'> Sub Total</td><td align='right'>$billTotal</td></tr>";
 	  echo "<tr><td colspan='4' align='right'> Tax </td><td align='right'>$tax</td></tr>";
	  echo "<tr><td colspan='4' align='right'> Shipping </td><td align='right'>$shipping</td></tr>";
	  echo "<tr><td colspan='4' align='right'> Total </td><td align='right'>$total</td></tr>";
	
		  $dbhost = 'localhost:3036';
	  $dbhost = 'localhost';
	  $dbuser = 'root';
	  $dbpass = '';
	  $db = 'product';
	  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

  if(! $conn ) {
    die('Could not connect: ' . mysqli_error($conn));
  } 
  $billFirst = $_POST['BillingFirst'];
  $billLast = $_POST['BillingLast'];
  $billAdd = $_POST['BillingAddress'];
  $billCity = $_POST['BillingCity'];
  $billState = $_POST['BillingState'];
  $billZip = $_POST['BillingZip'];
  $billEmail = $_POST['BillingEmail'];
  $shipMeth = $_POST['ShippingMethod'];
  $shipFirst = $_POST['ShippingFirst'];
  $shipLast = $_POST['ShippingLast'];
  $shipAdd = $_POST['ShippingAddress'];
  $shipCity = $_POST['ShippingCity'];
  $shipState = $_POST['ShippingState'];
  $shipZip = $_POST['ShippingZip'];
  $shipEmail = $_POST['ShippingEmail'];
  $payType = $_POST['PaymentCardType'];
  $payCardNum = $_POST['PaymentCreditCard'];
  $payCardExpire = $_POST['PaymentExpiration'];
  
  $_SESSION['ShipEmail'] = $shipEmail;
  

  $sqlCustomer = "INSERT INTO customerinfo (BillingFirstName, BillingLastName, BillingStreetAddress, BillingCity, BillingState, BillingZip, BillingEmail, ShippingMethod, ShippingFirstName, ShippingLastName, ShippingStreetAddress, ShippingCity, ShippingState, ShippingZip, ShippingEmail, PaymentType, PaymentCardNumber, PaymentCardExpiration) VALUES ('$billFirst', '$billLast', '$billAdd', '$billCity', '$billState', '$billZip', '$billEmail', '$shipMeth', '$shipFirst', '$shipLast', '$shipAdd', '$shipCity', '$shipState', '$shipZip', '$shipEmail', '$payType', '$payCardNum', '$payCardExpire')"; 

$retval = mysqli_query( $conn, $sqlCustomer ); 

if(! $retval ) {
  die('Could not get data: ' . mysqli_error($conn));
}

$orderId = mysqli_query($conn, "select MAX(orderID) from orderinfo");

foreach($cart as $cartkey => $cartItem) {
	$id = $cartItem['pid'];
	$price = $cartItem['price'];
	$qty = $cartItem['qty'];

	$itemTotal = $price * $qty;
	$sqlOrderinfo = "INSERT INTO orderinfo (Name, Price, Quantity, Total) VALUES ('$id', '$price', '$qty', '$itemTotal')";

	//$retval = mysqli_query( $conn, $sqlCustomer); 
	$retval = mysqli_query( $conn, $sqlOrderinfo ); 

if(! $retval ) {
  die('Could not get data: ' . mysqli_error($conn));
}
}
	mysqli_close($conn);
	?>
	</tbody>
	</table>








<body>
<table class="table table-sm table-dark table-striped table-bordered">
<td>


<h1>
Billing Information:
</h1>
</td>
<tr>
<td>First Name: <?php echo $_POST["BillingFirst"]; ?><br></td>
</tr>
</body>
<body>
<tr>
<td>Last Name: <?php echo $_POST["BillingLast"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Street Address: <?php echo $_POST["BillingAddress"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>City: <?php echo $_POST["BillingCity"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>State: <?php echo $_POST["BillingState"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Zip: <?php echo $_POST["BillingZip"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Email: <?php echo $_POST["BillingEmail"]; ?><br></td>
</tr>

</body>

<tr>
<td>
<h1>
Shipping Information:
</h1>
</td>
</tr>
<body>
<tr>
<td>Send Brochure: <?php
	if (isset($_POST['ShippingCheckbox'])){
		echo 'Yes'; 
	}
	else {
		echo 'No';
	}
	?><br></td>
</tr>

</body>
<body>

<tr>
<td>First Name: <?php echo $_POST["ShippingFirst"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Last Name: <?php echo $_POST["ShippingLast"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Street Address: <?php echo $_POST["ShippingAddress"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>City: <?php echo $_POST["ShippingCity"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>State: <?php echo $_POST["ShippingState"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Zip: <?php echo $_POST["ShippingZip"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Email: <?php echo $_POST["ShippingEmail"]; ?><br></td>
</tr>


</body>
<tr>
<td><h1>
Shipping Method:
</h1></td>
<body>
<tr>
<td><?php
if(isset($_POST['ShippingMethod'])){
$ship_val = $_POST['ShippingMethod']; 
echo "Method: " .$ship_val;
}
?><br></td>
</tr>
</body>

<tr>
<td><h1>
Payment Details
</h1></td>
</tr>

<body>
<tr>
<td><?php
if(isset($_POST['PaymentCardType'])){
$pay_val = $_POST['PaymentCardType']; 
echo "Card Type: " .$pay_val;
}

//session_abort();
?></td>
</tr>

</body>
<body>
<tr>
<td>Card Number: <?php echo $_POST["PaymentCreditCard"]; ?><br></td>
</tr>

</body>
<body>

<tr>
<td>Expiration Date: <?php echo $_POST["PaymentExpiration"]; ?><br></td>
</tr>

</table>

<form method="get" action="./thankyou.php">
<input type="submit" name="submitbutton" value = "Confirm Order" action="./thankyou.php">
</form>
</body>
</html>
