<?php
require ('dbConnection.php');
require ('product_DBaccess.php');
require ('user_DBaccess.php');
require ('orders_DBaccess.php');

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
	
$categories = get_categories();
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
				
				<!--<div class="row">
					<div class="col-2">
						<h1>List of Products</h1>
						<h2></h2>
						
						<form class="center-text">
							<table class="mytable"> <!--NEEDS STYLING
								<tr>
									<th>Product ID</th>
									<th>Name</th>
									<th>Price</th>
								</tr>
								
								<?php /*
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
									
								 */ ?>
								
							</table>
						</form>
						
					</div>
					
				</div> -->
		<div class="small-container">

			<?php while ($category_entry = $categories->fetch_assoc()) {
				$category = $category_entry['CATEGORY'];

			$products = get_products_by_category($category); } ?>

				<div class="row row-2">
					<h2><?php echo $category; ?> Products</h2>
				</div>

			<div class="row">

				<?php 
					include_once 'dbInteract.php';
				
					while ($product_entry = $products->fetch_assoc()) { ?>

					<div class="col-5">
						<img src="<?php echo $product_entry['PIMAGE']; ?>">
						<h4><?php echo $product_entry['PNAME']; ?></h4>
						<p>$<?php echo number_format($product_entry['PRICE'], 2); } ?></p>
						<!--<form action="products_to_cart_limbo.php" method="post">
							Amount: <input type="number" id="<?php //echo $product_entry['PRODUCTID']; ?>"
										name="<?php //echo $product_entry['PRODUCTID']; ?>" style="width:50px"; min="0">

							<input type="submit" name="cart" id="cart" value="Add to Cart"> -->
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
		
	</body>
</html>






