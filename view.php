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
    $result = mysqli_query($db, $query); 
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>

<!--    <script src="main.js"></script>-->
<!--	<link rel="stylesheet" type="text/css" href="css/style.css">-->
<!--    <link rel="stylesheet" href="css/bootstrap.css">-->
</head>

<body>
    <!-- Nav Bar -->


    <nav class=" navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Address Book</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="add.php">Add Contact</a></li>
                <li><a href="add.php?logout='1'">Log Out</a></li>
            </ul>
        </div>
    </nav>




    <br>


    <div class="container">
        <div class="col-sm-2"></div>
            <div class="col-8 ">
                <h2 id="h2">Contact List</h2>
                <hr />
                <div class="well">
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                        <!-- Header Row -->
                        <tr>
                            <th>Full Name</th>
                            <th>Nick Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Birth Date</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while( $rows = mysqli_fetch_array($result))   
                        {
                            ?>

                            <tr>
                                <td><?php echo $rows['full_name']; ?></td>
                                <td><?php echo $rows['nick_name']; ?></td>
                                <td><?php echo $rows['email']; ?></td>
                                <td><?php echo $rows['contact_number']; ?></td>
                                <td><?php echo $rows['birth_date']; ?></td>
                                <td><?php echo $rows['address']; ?></td>
                                
                                <td>
                                    <form  action="removecontact.php" method="post" style="" >
                                        <button id="remove_btn"  value="<?php echo $rows['id']; ?>" type="submit" name="delete_contact" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        <div class="col-sm-2"></div>
    </div>




    <br>

    <div class="col-sm-12 text-center">
        <form  action="csvDownload.php" method="post">
            <button id="csv_btn"  value="Download" type="submit" name="download_csv" class="btn btn-success">Download CSV</button>
        </form>

     </div>

</body>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</html>