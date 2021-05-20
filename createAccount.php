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
		
		<form id="form" action="createAccount_limbo.php" method="post">
			<div class="login-form">
				<h1>Create Account</h1>

				<label for="username"></label>
				<input type="text" placeholder="Username" name="username" id="username" class="input-box" required><br>

				<label for="password"></label>
				<input type="password" placeholder="Password" name="password" id="password" class="input-box" required><br>

				<div id="error"></div>

				<label for="confirmPassword"></label>
				<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password"class="input-box" required><br>
				
				<label for="fname"></label><input type="text" placeholder="First Name" name="fname" class="input-box">
					<label for="lname"></label><input type="text" placeholder="First Name" name="lname" class="input-box">
				
				<label for="address"></label>
					<input type="text" placeholder="Address" name="address" class="input-box">
				
				<label for="phone"></label>
					<input type="tel" placeholder="phone" name="phone" class="input-box">
				
				
					<label for="email"></label>
					<input type="text" placeholder="Email" name="email" class="input-box">
				
				<button type="submit" id="registerButton" name="registerButton" style="background-color: 008CBA;">Register</button>
			</div>
		</form>

		<script>
			var password = document.getElementById("password"),
			confirm_password = document.getElementById("confirm_password");

			function validatePassword() {
				if (password.value != confirm_password.value) {
					confirm_password.setCustomValidity("Passwords Don't Match");
				}
				  
				else {
				confirm_password.setCustomValidity("");
				}
			}
			password.onchange = validatePassword;
			confirm_password.onkeyup = validatePassword;


			form = document.getElementById('form')
			errorElement = document.getElementById('error')

			form.addEventListener('submit', (e) => {
				let messages = []
				
				if (password.value.length <= 5) {
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