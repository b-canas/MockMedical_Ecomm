
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="loginStyle.css">
		<title>VitiMins - Login Page</title>
	</head>
	<body>
		<?php
		include 'dbSendRegistrationInfo.php';
		?>
		
	
		<div class="login-form">
			<h1>Login</h1>

			<label for="username"></label>
			<input type="text" placeholder="Username" name="username" class="input-box"><br>

			<label for="password"></label>
			<input type="text" placeholder="Password" name="password" class="input-box"><br>

			<button type="submit" style="background-color: 008CBA;">Login</button>

			<hr>
			
			<p> Don't have an account? Sign up <a href="createAccount.php">here</a></p>
			
			


		</div>

		
	</body>
</html>