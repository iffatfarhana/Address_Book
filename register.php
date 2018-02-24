<?php include('server.php');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>
    
    <form method = "post" action="register.php">
        <!-- Show validation error here -->
        <?php include('errors.php') ?>
        <div class = "input-group">
            <label>Username</label>
            <input type="text" name = "username">
        </div>
        <div class = "input-group">
            <label>Password</label>
            <input type="password" name = "password_1">
        </div>
        <div class = "input-group">
            <label>Confirm Password</label>
            <input type="password" name = "password_2">
        </div>
        <div class = "input-group">
            <button type="submit" name="register" class="btn">Register</button>
        </div>
        <p>Already a member? <a class="a_btn" href="login.php">Login</a></p>
    </form>

</body>
</html>