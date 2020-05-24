<!DOCTYPE html>
<html>
<?php session_start(); ?>
    <head>
        <title>Thank You For Your Order</title>
        <h1>Thank You For Your Order</h1>
    </head>
    <body>
        <img src="./images/the-new-movement_DP7941_S.jpg">
		
        <p>An order confirmation email has been sent to <?php echo $_SESSION['ShipEmail'];?></p>
    </body>
<?php session_abort(); ?>
</html>