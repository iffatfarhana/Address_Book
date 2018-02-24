<?php

session_start();

// Database Connection
$db = mysqli_connect('localhost', 'root', '', 'registration');

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name']; //*********
    $password = $_SESSION['password'];
}

  //************ */

    if(isset($_POST['delete_contact'])) {

        $id = $_POST['delete_contact'];

        $query = "DELETE FROM contact_list WHERE id= '$id'";
        $result = mysqli_query($db, $query);

        if ($result == 1) { // If the query selects only one row then log in
            header('location: view.php');
        }else {
            echo  "Failed";
        }

    }
?>