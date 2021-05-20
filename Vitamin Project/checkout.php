<?php
	//CPY -v-
	session_start();
	$username="";
	$userid="";
	$password="";
	$access="";
	
	$loggedin=false;
	if(isset($_SESSION['username'])) {
		$loggedin=true;
		$username=$_SESSION['username'];
		$userid=$_SESSION['userid'];
		$password=$_SESSION['password'];
		$access=$_SESSION['access'];
		
		echo "loggedin";
	}
	else {
		echo "unlogged";
	}
	echo "<br>";
	//CPY -^-
?> 
<html lang = "en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial scale=1.0">
		<title>VitiMins - Checkout</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<div class="header">
			<div class="container">
			
				<div class="navbar">
				<div class="logo">
					<!-- <img src="images/ " width="125px"> -->
					<span id="text_logo"><h1>VitiMins</h1></span>
				</div>
					<nav class="banner">
						<ul id="MenuItems">
							<li><a href="index.php" >Home</a></li>
							<li><a href="products_limbo.php" class="active">Products</a></li>
							<li><a href="">About</a></li>
							<li><a href="">Contact</a></li>
							<li><a href="">Account</a></li>
							<li><a href="orders_limbo.php">Orders</a></li>
							<li><a href="cart_limbo.php"><img src="images/cart.png" width="30px"
							height="30px"></a></li>
							<li>
								<?php
								if($loggedin) {
									echo "<a href=\"logout_limbo.php\">Logout</a>";
								}
								else {
									echo "<a href=\"login.php\">Login</a>";
								}
								?>
							</li>
						</ul>
					</nav>
					<img src="images/menu.png" class="menu-icon"
					onclick="menutoggle()">
				
		<div class="row">
			<div class="col-2">
				<h1 class="center-text">Review your order</h1>
			<br>
			<form class="center-text" method="post" action="buy_limbo.php">
				<table id="checkout_table">
					<tr>
						<th>Product ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Amount</th>
						<th>Cost</th>
					</tr>
					<?php
						require 'dbInteract.php';
						
						$result=getCart($userid);
						$total=0;
						while($row=$result->fetch_assoc()) {
							$productid=$row['PRODUCTID'];
							$amount=$row['AMOUNT'];
							
							$product=getProduct($productid);
							$pname=$product['PNAME'];
							$price=$product['PRICE'];
							
							$cost=$price*$amount;
							$total+=$cost;
							echo "<tr>
								<td>$productid</td>
								<td>$pname</td>
								<td>\$$price</td>
								<td>$amount</td>
								<td>\$$cost</td>
							</tr>";
						}
						?>
						<tr>
							<th>Total:</th>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>$<?php echo $total ?></td>
						</tr>
						<tr>
							<td></td>
							<td>Credit Card: </td>
							<td><input type="number" name="i_creditcard" placeholder="credit card with no spaces"></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>CCV: </td>
							<td><input type="number" name="i_ccv" placeholder="3 numbers on the back"></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>Expiration Date: </td>
							<td><input type="number" name="i_expMonth" placeholder="month"></td>
							<td>/<input type="number" name="i_expYear" placeholder="year"></td>
						</tr>
						<tr>
							<td><button type="submit" name="buy">Buy Now</button></td>
						</tr>
					
					
					
				</table>
			</form>
						
					</div>
					
				</div>
			</div>
		</div>
		
		<! ------Footer------ />
		
		<div class="footer">
			<div class="row">
				<p>Our purpose is to distribute vitamins quickly
				and easily to the comfort of your own home.</p>
			</div>
			<hr>
			<p class="copyright">Copyright 2021 - Software Engineering II </p>
		</div>
		
	</body>
</html>






