<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="loginStyle.css">
		<title>VitiMins - Create Account</title>
	</head>
	<body>
		<?php
		include 'dbConnection.php';
		?>
		
		<form action="index.php" method="post">
			<div class="login-form">
				<h1>Create Account</h1>

				<label for="username"></label>
				<input type="text" placeholder="Username" name="registrationUsername" id="registrationUsername" class="input-box"><br>

				<label for="password"></label>
				<input type="text" placeholder="Password" name="registrationPassword" id="registrationPassword"class="input-box"><br>

				<button type="submit" id="registerButton" name="registerButton" style="background-color: 008CBA;">Register</button>
			</div>
		</form>

		
	</body>
</html>