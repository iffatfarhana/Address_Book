<?php
   session_start();

   $username = "";
   $errors = array();
   $_SESSION['success'] = "";
   // Database Connection
    $db = mysqli_connect('localhost', 'root', '', 'registration');

    // If register button is pressed
    if(isset($_POST['register'])) {
        $username = $_POST["username"];
        $password_1 = $_POST["password_1"];
        $password_2 = $_POST["password_2"];
        
        // Form validation: Ensure all the fields are filled properly
        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2) {
            array_push($errors, "The two passwords don't match");
        }
        // register user if there are no errors in the form
        if(count($errors) == 0) {
            $password = ($password_1);  //Encryption
            $query = "INSERT INTO users (name, password) VALUES('$username', '$password')";

            mysqli_query($db, $query);

            $_SESSION['name'] = $username;  //************* */
            $_SESSION['password'] = $password; //***************** */
            $_SESSION['success'] = "You are now logged in";
            header('location: register.php');
        }

    }
    // If Login button is pressed
    if(isset($_POST['login'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($password)) {
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0) {
			$query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
			$results = mysqli_query($db, $query);   // Retrive data from database

			if (mysqli_num_rows($results) == 1) { // If the query selects only one row then log in
                $_SESSION['name'] = $username;
                $_SESSION['password'] = $password;
				$_SESSION['success'] = "You are now logged in";
				header('location: add.php');
			}else {
				array_push($errors, "Wrong Username or Password");
			}
		}
    }
?>