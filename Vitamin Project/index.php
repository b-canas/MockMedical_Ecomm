
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="loginstyle.css">
		<title>VitiMins - Login Page</title>
	</head>
	<body>
		<?php
		include 'dbConnection.php';
		?>
		<p>
		<div class="nav">
			
			<div class="nav-title">
				<li>VitiMins</li>
			</div>
			
			<div class="nav-links">
				<li><a href="home.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
			</div>
			
		</div>
		
		<div class="center">
			<h1>Login</h1>

			<label for="username"></label>
			<input type="text" placeholder="Username" name="username"><br>

			<label for="password"></label>
			<input type="text" placeholder="Password" name="password"><br>

			<button type="submit" style="background-color: 008CBA;">Login</button>

		</div>

		
	</body>
</html>