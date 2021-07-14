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
		<title>VitiMins - Products</title>
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
							<li><a href="index.php" class="active">Home</a></li>
							<li><a href="products_limbo.php">Products</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="">Account</a></li>
							<li><a href="orders_limbo.php">Orders</a></li>
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
					<a href="cart_limbo.php"><img src="images/cart.png" width="30px"
					   height="30px"></a>
					<img src="images/menu.png" class="menu-icon"
					onclick="menutoggle()">
				</div>
				
				<div class="row">
					<div class="col-2">
						<!-- EDIT-->
						<h1 class="center-text">Your Cart:</h1>
			<br>
			<form class="center-text" method="post" action="cart_view_limbo.php">
				<table id="cart_table">
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
						while($row=$result->fetch_assoc()) {
							$productid=$row['PRODUCTID'];
							$amount=$row['AMOUNT'];
							
							$product=getProduct($productid);
							$pname=$product['PNAME'];
							$price=$product['PRICE'];
							
							$cost=$price*$amount;
							
							echo "<tr>
								<td>$productid</td>
								<td>$pname</td>
								<td>$price</td>
								<td><input type=\"number\" id=\"$productid\" name=\"$productid\" value=$amount></td>
								<td>$cost</td>
							</tr>";
						}
						echo "<tr>
							<td><button type=\"submit\" name=\"update\">Update Cart</button></td>
							<td><button type=\"submit\" name=\"buy\">Check Out</button></td>
						</tr>";
					?>
					
					
				</table>
			</form>
						<!-- ENDIT -->
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






