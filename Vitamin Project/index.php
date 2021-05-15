<?php

	if(session_status() === PHP_SESSION_NONE){
		//No session has been created yet, so create a new one.
		session_start([
		    'cookie_lifetime' => 86400, //cookie lifetime. 86400 seconds == 1 day
		]);
	} else //A session may exist already so session_start() will resume the session
		session_start();

	if (isset($_SESSION['user_id'])) { //A user is already logged in and hasn't logged out
		if ($_SESSION['access'] == 0)
		    header('location: vitimins_worker.php');
		else
		    header('location: products.php');
	}
?>

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
