<?php 
  
  session_start(); 
  $errors = array();
  $full_name = "";
  if (!isset($_SESSION['name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    }

   if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header("location: index.html");
    }

     // Database Connection
     $db = mysqli_connect('localhost', 'root', '', 'registration');
     // If Save button is pressed
    if(isset($_POST['save'])) {
        if (isset($_SESSION['name'])) {
            $username = $_SESSION['name']; //********* 
            $password = $_SESSION['password'];
        }

        $identified = mysqli_query($db,"SELECT id FROM users WHERE name = '$username' AND password ='$password' ");
        $row = mysqli_fetch_array($identified);
        $user_id = $row['id']; //************ */

        $full_name = $_POST["full_name"];
        $nick_name = $_POST["nick_name"];
        $email = $_POST["email"];
        $contact_number = $_POST["contact_number"];
        $birth_date = $_POST["birth_date"];
        $address = $_POST["address"];


    
        if(empty($full_name)) {
            array_push($errors, "Full Name is required");
        }
        if(empty($nick_name)) {
            array_push($errors, "Nick Name is required");
        }
        if(empty($email)) {
            array_push($errors, "Email is required");
        }
        if(empty($contact_number)) {
            array_push($errors, "Contact Number is required");
        }
        if(empty($birth_date)) {
            array_push($errors, "Birth Date is required");
        }
        if(empty($address)) {
            array_push($errors, "Address is required");
        }


        
        $query = "INSERT INTO contact_list (user_id, full_name, nick_name, email, contact_number, birth_date, address) VALUES ('$user_id', '$full_name', '$nick_name', '$email', '$contact_number', '$birth_date', '$address')";
        mysqli_query($db, $query);
    }

?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="#">Address Book</a>


            <ul class="navbar-nav ml-auto">
                <li>
                    <a class="nav-link" href="view.php?" >View Contact</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php?logout='1'" >Log Out</a>  <!-- **** --> 
                </li>
            </ul>
        </div>
    </nav>
	<div class="header">
        <h2>Add Contacts</h2>
    </div>
    <form method = "post" action="add.php">
            <!-- Display validation error here -->
            <?php include('errors.php') ?>
            <div class = "input-group">
                <label>Full Name</label>
                <input type="text" name = "full_name">
            </div>
            <div class = "input-group">
                <label>Nick Name</label>
                <input type="text" name = "nick_name">
            </div>
            <div class = "input-group">
                <label>Email</label>
                <input type="email" name = "email">
            </div>
            <div class = "input-group">
                <label>Contact Number</label>
                <input type="text" name = "contact_number">
            </div>
            <div class = "input-group">
                <label>Birth Date</label>
                <input type="date" name = "birth_date">
            </div>
            <div class = "input-group">
                <label>Address</label>
                <input type="text" name = "address">
            </div>

            <div class = "input-group">
                <button type="submit" name="save" class="btn">Save</button>
            </div>
            
        </form>		
</body>
</html>