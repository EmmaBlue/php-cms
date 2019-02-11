<?php 
    require_once('scripts/config.php');
    confirm_logged_in();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to your admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h3>Welcome <?php echo $_SESSION['user_name'];?></h3>
    <p>This is the admin dashboard page</p>
    <?php  
        // If user has logged in successfully before
        if ($_SESSION['date'] !== "0000-00-00 00:00:00") {

            //Create date create object to format date  
            $date = date_create($_SESSION['date']);
            date_default_timezone_set('America/Toronto');
            $date_formatted = (date_format($date, '\o\n l jS F Y \a\t g:ia'));
            echo 'The last successful login was '.$date_formatted;
        }

    ?>
     <p>
        <?php
            //Set correct timezone
            date_default_timezone_set('America/Toronto');
            $login_time = date('H');
            //If before noon
            if ($login_time < "12") {

                echo "Good morning";
            }
            //If between noon and 5 
            else if ($login_time >= "12" && $login_time < "17") {

                echo "Good afternoon";
            }
            
            else {
                echo "Good night";
            }
        ?>
     </p>
     <?php

     ?>
    <nav>
        <ul>
            <li><a href="admin_createuser.php">Create User</a></li>
            <li><a href="#">Edit User</a></li>
            <li><a href="#">Delete User</a></li>
            <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
        </ul>
    </nav>
</body>
</html>