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
						<!img src="images/ " width="125px">
					</div>
					
					<nav>
						<ul id="MenuItems">
							<li><a href="index.php" >Home</a></li>
							<?php
								if($loggedin) {
									echo "<a href=\"logout_limbo.php\">Logout</a>";
								}
								else {
									echo "<a href=\"login.php\">Login</a>";
								}
							?>
							<li><a href="products_limbo.php" class="active">Products</a></li>
							<li><a href="">About</a></li>
							<li><a href="">Contact</a></li>
							<li><a href="">Account</a></li>
							<li><a href="cart_limbo.php">Cart</a></li>
							<li><a href="checkout_limbo.php">Checkout</a></li>
							<li><a href="orders_limbo.php">Orders</a></li>
						</ul>
					</nav>
					<img src="images/cart.png" width="30px" height="30px">
					<img src="images/menu.png" class="menu-icon"
					onclick="menutoggle()">
				</div>
				
				<div class="row">
					<div class="col-5">
						<h1 class="center-text">Review your order</h1>
			<br>
			<form class="center-text" method="post" action="buy_limbo.php">
				<table>
					<tr>
						<th>Proudct ID</th>
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
			<div class="container">
				<div class="row">
					<div class="footer-col-1">
						<p>Our Purpose Is To Distribute Vitamins Quickly
						and Easily To the Confort of Your Own Home.</p>
					</div>
				</div>
				<hr>
				<p class="copyright">Copyright 2021 - Software Engineering II </p>
			</div>
		</div>
		
	</body>
</html>






