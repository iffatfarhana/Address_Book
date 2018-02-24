<?php

session_start();

// Database Connection
$db = mysqli_connect('localhost', 'root', '', 'registration');

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name']; //*********
    $password = $_SESSION['password'];
}

$identified = mysqli_query($db,"SELECT id FROM users WHERE name = '$username' AND password ='$password' ");
$row = mysqli_fetch_array($identified);
$user_id = $row['id']; //************ */

$query = "SELECT * FROM contact_list where user_id = '$user_id'";
$result = mysqli_query($db, $query);  //************ */

if(isset($_POST['download_csv'])) {

    $filename = "Contact_Information.csv";
    $fp = fopen('php://output', 'w');

    $header = array(
        'Full Name',
        'Nick Name',
        'Email',
        'Contact Number',
        'Birth Date',
        'Address',
    );

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    fputcsv($fp, $header);

    $csv_query = "SELECT full_name, nick_name, email, contact_number, birth_date, address  FROM contact_list where user_id = '$user_id'";
    $csv_result = mysqli_query($db, $csv_query);

    while($row = mysqli_fetch_row($csv_result)) {
        fputcsv($fp, $row);
    }
}
?>