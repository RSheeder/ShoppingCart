<!DOCTYPE html>
<html>
<!doctype html>
<html lang="en">
<?php session_start();
	$refreshButtonPressed = isset($_SERVER['HTTP_CACHE_CONTROL']) && 
                            $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
							
	if (!empty($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	}
	?>
<head>
<title>Customer Information</title>
<link rel="stylesheet" href="./css/customerinfo.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>

<form action="./confirm.php" method="post">
 <div class="container">
 <table class="table table-sm table-dark table-striped table-bordered">
  <th colspan="2">
  <h2>Customer Information</h2>
  </th>
  <tr>
  <td>
	<h3>Your Billing Address:</h3><br>
		<label for="BillingFirst">First Name:</label><input type="text" Name="BillingFirst"><br>
		<label for="BillingLast">Last Name:</label><input type="text" Name="BillingLast"><br>
		<label for="BillingAddress">Street Address:</label><input type="text" Name="BillingAddress"><br>
		<label for="BillingCity">City:</label><input type="text" Name="BillingCity"><br>
		<label  for="BillingState">State:</label><select name="BillingState">
			<option value="AL">AL</option>
			<option value="FL">FL</option>
			<option value="GA">GA</option>
			<option value="LA">LA</option>
			<option value="MI">MI</option>
			</select><br>
		<label for="BillingZip">Zip:</label><input type="text" Name="BillingZip"><br>
		<label for="BillingEmail">Email:</label><input type="text" Name="BillingEmail"><br>
  </td>
  <td>
 	<h3>Your Shipping Address:</h3><br>
		<input type="checkbox" Name="ShippingCheckbox">Send Company Brochure?<br>
		<label for="ShippingFirst">First Name:</label><input type="text" Name="ShippingFirst"><br>
		<label for="ShippingLast">Last Name:</label><input type="text" Name="ShippingLast"><br>
		<label  for="ShippingAddress">Street Address:</label><input type="text" Name="ShippingAddress"><br>
		<label  for="ShippingCity">City:</label><input type="text" Name="ShippingCity"><br>
		<label  for="ShippingState">State:</label><select Name="ShippingState">
			<option value="AL">AL</option>
			<option value="FL">FL</option>
			<option value="GA">GA</option>
			<option value="LA">LA</option>
			<option value="MI">MI</option>
			</select><br>
		<label  for="ShippingZip">Zip:</label><input type="text" Name="ShippingZip"><br>
		<label  for="ShippingEmail">Email:</label><input type="text" Name="ShippingEmail"><br>
  </td>
  </tr>
  <tr>
    <td>
	<h3>Your Shipping Method:</h3>
		<input type="radio" checked="checked" name="ShippingMethod" value="2-Day">2-Day<br>
		<input type="radio" name="ShippingMethod" value="1-Day">1-Day<br>
		<input type="radio" name="ShippingMethod" value="Overnight">Overnight<br>
	</td>
    <td>
	<h3>Your Payment Details:</h3>
		Credit Card Type:<br>
		<input type="radio" name="PaymentCardType" value="Visa Card">Visa Card <br>
		<input type="radio" name="PaymentCardType" value="Discover Card">Discover Card <br>
		<input type="radio" name="PaymentCardType" value="Master Card">Master Card <br><br>
		<label  for="PaymentCreditCard">Credit Card #:</label><input type="text" Name="PaymentCreditCard"><br>
		<label  for="PaymentExpiration">Expiration Date (mm/yy):</label><input type="text" Name="PaymentExpiration"><br>
	</td>
  </tr>
  <tr>
  <td style= height:25px colspan="2">
<input type="submit" value = "Place Order">
  </td>
</table> 
 </div>
</form>
</body>
</html>