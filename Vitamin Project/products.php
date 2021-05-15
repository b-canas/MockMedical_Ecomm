<?php
require ('dbConnection.php');
require ('product_DBaccess.php');
require ('user_DBaccess.php');
require ('orders_DBaccess.php');

$categories = get_categories();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial scale=1.0">
	<title>All Products - VitiMins</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="header">

		<div class="container">

			<div class="navbar">
				<div class="logo">
					<!img src="images/ " width="125px">
				</div>

				<nav>
					<ul id="MenuItems">
						<li><a href="">Home</a></li>
						<li><a href="">Products</a></li>
						<li><a href="">About</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Account</a></li>
					</ul>
				</nav>
				<img src="images/cart.png" width="30px" height="30px">
				<img src="images/menu.png" class="menu-icon"
				onclick="menutoggle()">
			</div>

		</div>

		<div class="small-container">

			<?php while ($category_entry = $categories->fetch_assoc()) {
				$category = $category_entry['CATEGORY'];

				$products = get_products_by_category($category); ?>

				<div class="row row-2">
					<h2><?php echo $category; ?> Products</h2>
				</div>

				<div class="row">

				<?php while ($product_entry = $products->fetch_assoc()) { ?>

					<div class="col-5">
						<img src="images/bottleA.png">
						<h4><?php echo $product_entry['PNAME']; ?></h4>
						<p>$<?php echo number_format($product_entry['PRICE'], 2); ?></p>
						Amount: <input type="number" id="<?php $product_entry['PRODUCTID']; ?>"
									name="<?php $product_entry['PRODUCTID']; ?>" style="width:50px";>
					</div>

			<?php } echo '</div>'; } ?>

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
