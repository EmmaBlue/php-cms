<?php
    //check that user is logged in before being allowed to access page
    require_once('scripts/connect.php');
    require_once('scripts/config.php');
    confirm_logged_in();
    $id = $_SESSION['user_id'];
    $tbl = 'tbl_user';
    $col = 'user_id';

    //DRY way of doing getting all information from logged in user

    $found_user_set = getSingle($tbl,$col,$id);
    if(is_string($found_user_set)){
        $message = 'Failed to get user info!';
    }

     //If user submitted to form, don't want user to be created when page refreshed
     if(filter_has_var(INPUT_POST,'submit')){
        //trim = if user adds lots of spaces, trim gets rid of space before + after string
       // all input fields assigned to PHP variable
        $fname = trim($_POST['fname']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        //Validation so email and password are required
        //Deal with exception before normal behaviour
        if(empty($username) || empty($password) || empty($email)) {
            $message = 'Please fill the required fields!';
        } else {

            //Edit user
            $result = editUser($id, $fname, $username, $password, $email);
            $message = $result;

        }

    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h2>Edit User</h2>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif ?>
    <!---Only displays form if there's an existing user in database that matches logged in user--->
    <?php if($found_user = $found_user_set->fetch(PDO::FETCH_ASSOC)): ?>
        <form action="admin_edituser.php" method="post">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="fname" value="<?php echo $found_user['user_fname'];?>"><br><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $found_user['user_name'];?>"><br><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?php echo $found_user['user_pass'];?>"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $found_user['user_email'];?>"><br><br>
            <button type="submit" name="submit">Edit User</button>
        </form>
    <?php endif;?>

     <nav>
        <ul>
            <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
        </ul>
    </nav>

</body>
</html>