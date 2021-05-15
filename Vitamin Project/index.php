
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
		
		<form action="loginAccount.php" method="post">
			<div class="login-form">
				<h1>Login</h1>

				<label for="username"></label>
				<input type="text" id="username" placeholder="Username" name="username" class="input-box" required><br>

				<label for="password"></label>
				<input type="password" id="password" placeholder="Password" name="password" class="input-box" required><br>

				<button type="submit" id="loginButton" style="background-color: 008CBA;">Login</button>

				<hr>
				
				<p> Don't have an account? Sign up <a href="createAccount.php">here</a></p>
		</form>
			


		</div>

		
	</body>
</html>