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
		//echo "loggedin with $userid $username  $password $access";
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
		<title>VitiMins</title>
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
				
				<div class="contact-header">
					<h1> Contact Us </h1>
				</div>
				<div class="contact-form">
					<form method="POST">
						<input type="text" class="input-field" placeholder="Enter Name" required>
						<input type="email"class="input-field" placeholder="Enter Email" required>
						<input type="text" class="input-field" placeholder="Enter Subject" required>
						<input type="textarea" class="input-field textarea-field" placeholder="Write 
						 Message Here" width="300px" height="250px" required>
						<button type="submit">Send</button>
					</form>
				
				</div>
			</div>
		</div>
		
		<! ------Footer------ />
		
		<div class="footer">
			<div class="container">
				<div class="row">
					<p>Our purpose is to distribute vitamins quickly
					and easily to the comfort of your own home.</p>
				</div>
				<hr>
				<p class="copyright">Copyright 2021 - Software Engineering II </p>
			</div>
		</div>
		<! Java Script for the Menu Toggle Button >
		<script>
			var MenuItems = document.getElementById("MenuItems");
			
			MenuItems.style.maxHeight = "0px";
			
			function menutoggle(){
				if(MenuItems.style.maxHeight == "0px")
				{
					MenuItems.style.maxHeight = "200px";
				}
				else
				{
					MenuItems.style.maxHeight = "0px";
				}
			}
		</script>
	</body>
</html>