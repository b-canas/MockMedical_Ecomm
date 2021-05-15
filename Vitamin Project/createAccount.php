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
		
		<form id="form" action="index.php" method="post">
			<div class="login-form">
				<h1>Create Account</h1>

				<label for="username"></label>
				<input type="text" placeholder="Username" name="registrationUsername" id="registrationUsername" class="input-box" required><br>

				<label for="password"></label>
				<input type="password" placeholder="Password" name="registrationPassword" id="registrationPassword"class="input-box" required><br>

				<div id="error"></div>

				<label for="confirmPassword"></label>
				<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password"class="input-box" required><br>

				<button type="submit" id="registerButton" name="registerButton" style="background-color: 008CBA;">Register</button>
			</div>
		</form>

<script>
	var registrationPassword = document.getElementById("registrationPassword"),
  	confirm_password = document.getElementById("confirm_password");

	function validatePassword() {
  		if (registrationPassword.value != confirm_password.value) {
    		confirm_password.setCustomValidity("Passwords Don't Match");
		}
		  
		else {
    	confirm_password.setCustomValidity("");
  		}
	}
	registrationPassword.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;


	form = document.getElementById('form')
	errorElement = document.getElementById('error')

	form.addEventListener('submit', (e) => {
		let messages = []
		
		if (registrationPassword.value.length <= 5) {
		messages.push("password must contain atleast 6 characters")
		}

		if (messages.length > 0) {
			e.preventDefault()
			errorElement.innerText = messages.join(', ')
		}
	})
</script>

		
	</body>
</html>