<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    require_once('scripts/config.php');
    confirm_logged_in();

    $tbl = 'tbl_user';

    //DRY way of doing getting all information from all users

    $get_users = getAll($tbl);
    $users = array();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h2>Time to destroy...</h2>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>User Email</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php  //Need to do while loop with fetch if you want more than the first row, Need to do fetch because we needed multiple objects rather than one with the getSingle function
                while($user = $get_users->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <td><?php echo $user['user_id'];?></td>
                <td><?php echo $user['user_fname'];?></td>
                <td><?php echo $user['user_email'];?></td>
                <td><a href="scripts/caller.php?caller_id=delete&id=<?php echo $user['user_id']; ?>">Delete User</a></td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>

</body>
</html>