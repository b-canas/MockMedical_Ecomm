<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Medicine Site</title>
</head>
<body>
    <?php
    include 'dbConnection.php';
    ?>

    
    <div class="center">

        <h1>Login</h1>

        <label for="username"></label>
        <input type="text" placeholder="Username" name="username"><br>

        <label for="password"></label>
        <input type="text" placeholder="Password" name="password"><br>

        <button type="submit">Login</button>

    </div>

    
</body>
</html>