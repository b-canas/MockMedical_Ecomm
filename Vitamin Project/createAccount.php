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

				<label for="first_name"></label>
				<input type="text" placeholder="First Name" name="first_name" id="first_name"class="input-box" required><br>

				<label for="last_name"></label>
				<input type="text" placeholder="Last Name" name="last_name" id="last_name"class="input-box" required><br>

				<label for="address"></label>
				<input type="text" placeholder="Address" name="address" id="address"class="input-box" required><br>

				<label for="phone_number"></label>
				<input type="tel"  pattern ="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone Number  Ex: 957-312-1234" name="phone_number" id="phone_number"class="input-box" required><br>

				<label for="email"></label>
				<input type="email" placeholder="Email" name="email" id="email"class="input-box" required><br>

				

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