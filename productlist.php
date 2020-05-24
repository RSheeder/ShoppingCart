<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/customerinfo.css">
		<title>Product List</title>
  </head>
  <body>
	<header><h1>Product List</h1></header>
		<div class="container">
		  <table class="table table-sm table-dark table-striped table-bordered table-hover">
			  <thead>
				  <th style="width: 18%">Image</th>
				  <th style="width: 18%">Name</th>
				  <th style="width: 54%">Description</th>
          <th style="width: 10%">Price</th>
			  </thead>
			  <tbody>
          <?php
	session_start();
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
		        $db = 'product';
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
         
            if(! $conn ) {
              die('Could not connect: ' . mysql_error());
            }

		        $retval = mysqli_query( $conn, "SELECT * FROM product" );
		        while($row = mysqli_fetch_assoc($retval)) {
              echo "<tr>";
              echo "<th><img src=\"{$row['image']}\" style=\"max-width: 250px; display: block; margin-left: auto; margin-right: auto;\"></th>";
              echo "<td>{$row['title']}</td>";
              echo "<td>{$row['description']}</td>";
              echo "<td style=\"text-align: center\">";
              echo "$" . "{$row['price']}<br>";
              if ($row['stock'] != 0){
			  echo "<a href=\"./shoppingcart.php?productid=" . $row['title'] . 
                "&productname=" . $row['title'] . "&productprice=" . $row['price'] . "\" >add to cart</a>";
			  }else{ echo "out of stock"; }
			  echo "</td>";
              echo "</tr>";
            } 
            mysqli_close($conn);
          ?>
			  </tbody>
		  </table>
	  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>