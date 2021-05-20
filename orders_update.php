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
						<!-- EDIT-->
						<h1 class="center-text">A look at previous orders</h1>
			<h2 class="center-text">Orders succsessfully updated!</h2> 
			<br>
			<form class="center-text" method="post" action="orders_update_limbo.php">
				<table>
					<tr>
						<th>Order No/Product ID</th>
						<th>Name/Username</th>
						<th>Price</th>
						<th>Amount</th>
						<th>Cost</th>
						<th>Status</th>
					</tr>
					<?php
						require 'dbInteract.php';
						
						$result="";
						$uidtouse="";
						if($access<0) {
							$uidtouse=$userid;
							$result=getOrdernoFromUser($uidtouse);
						}
						else
							$result=getOrdernos();
						
						while($row=$result->fetch_assoc()) {
							$orderno=$row['ORDERNO'];
							$status=$row['STATUS'];
							$totalcost=$row['TOTALCOST'];
							$orderuserid=$row['USERID'];
						
							echo "<tr>
								<th>$orderno</th>";
								
							echo	"<th>-</th>";
							$name="-";
							if($access>=0) {
								$user=getUser($orderuserid);
								$name=$user['USERNAME'];
							}
							echo "	<th>$name</th>
								<th>-</th>
								<th>$totalcost</th>";
								echo "<th>";
									echo "<select id=\"s_status$orderno\" name=\"s_status$orderno\" selected=
									\"$status\">";
										if($access>=0) {
											echo "<option value=\"ready\">READY</option>";
											echo "<option value=\"shipped\">SHIPPED</option>";
											echo "<option value=\"delivered\">DELIVERED</option>";
										}
										else if($status!="CANCELLED") {
											echo "<option value=\"ready\">READY</option>";
										}
										
										echo "<option value=\"cancelled\">CANCELLED</option>";
									echo "</select>";
								echo "</th>";
							echo "</tr>";
							
							
							$userOrder=getOrdersFromUser($orderuserid,$orderno);
							
							while($entry=$userOrder->fetch_assoc()) {
								$productid=$entry['PRODUCTID'];
								$amount=$entry['AMOUNT'];
								$icost=$entry['ICOST'];
								$tprice=$entry['TPRICE'];
								
								$product=getProduct($productid);
								$pname=$product['PNAME'];
								
								echo "<tr>
									<td>$productid</td>
									<td>$pname</td>
									<td>$icost</td>
									<td>$amount</td>
									<td>$tprice</td>
								</tr>";
							}
						}
						
						?>
						
						<tr>
							<td><button type="submit" name="update">Update orders</button></td>
						</tr>
					
					
					
				</table>
			</form>
						<!-- ENDIT -->
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






