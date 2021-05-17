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
						</ul>
					</nav>
					<img src="images/cart.png" width="30px" height="30px">
					<img src="images/menu.png" class="menu-icon"
					onclick="menutoggle()">
				</div>
				
				<div class="row">
					<div class="col-5">
						<h1>List of Products</h1>
						<h2></h2>
						
						<form class="center-text">
							<table class="mytable"> <!--NEEDS STYLING-->
								<tr>
									<th>Product ID</th>
									<th>Name</th>
									<th>Price</th>
								</tr>
								
								<?php
									require 'dbInteract.php';
									
									$result=getProducts();
									
									while($row=$result->fetch_assoc()) {
										$productid=$row['PRODUCTID'];
										$pname=$row['PNAME'];
										$price=$row['PRICE'];
										
										echo "
										<tr>
											<td>$productid</td>
											<td>$pname</td>
											<td>\$$price</td>
										</tr>";
									}
									
								?>
								
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






