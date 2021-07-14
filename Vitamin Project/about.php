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
				
				<div class="row">
				<div class="col-2">
				<h1>VitiMins Staff</h1>
					<div class="col-2_aboot">
						<h3>Dr. Jonathan Alves</h3>
						<p>A devoted worker, Dr. Alves loaned his time to login
						   functionality and the design associated with such. He
						   contributed greatly to the backend through his efforts.</p>
					</div>
					<div class="col-2_aboot">
						<h3>Dr. Brian Canas</h3>
						<p>Dr. Canas worked tirelessly to shore up the backend
						   wherever needed, focusing mainly on the products and
						   admin view. He also was instrumental with integration and
						   basic design.</p>
					</div>
					<div class="col-2_aboot">
						<h3>Dr. Zachary Joy</h3>
						<p>Dr. Joy focused his efforts on the front-end, working
						   with his colleagues to ensure a consistent website design
						   through CSS. In between he also contributed to the
						   products page and minimal PHP edits where needed.</p>
					</div>
					<div class="col-2_aboot">
						<h3>Dr. Walter Lampmann</h3>
						<p>Dr. Lampmann designed the home and contact pages. He was
						   instrumental in the core design of the website and also
						   contributed with uploading visual aids.</p>
					</div>
					<div class="col-2_aboot">
						<h3>Dr. Mike Nodarse</h3>
						<p>Dr. Nodarse's research had breakthroughs in the cart
						   functionality and other backend code along with Dr. Canas.
						   He is solely responsible for the working cart and for being
						   an excellent team player.</p>
					</div>
				</div>
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