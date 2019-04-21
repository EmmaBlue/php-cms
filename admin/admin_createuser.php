<!DOCTYPE html>
<html>
<?php
    //check that user is logged in before being allowed to access page
    require_once('scripts/config.php');
   // confirm_logged_in();
    //If user submitted to form, don't want user to be created when page refreshed
    if(isset($_POST['submit'])){
        //trim = if user adds lots of spaces, trim gets rid of space before + after string
       // all input fields assigned to PHP variable
        $fname = trim($_POST['fname']);
        $username = trim($_POST['username']);
       // $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        //Validation so email and password are required
        //Deal with exception before normal behaviour
        if(empty($username)) {
            $message = 'Please fill the required fields!';
        } else {

            //Create user
            $result = createUser($fname, $username, $email);
            $message = $result;

        }

    }

?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif ?>
    <h2>Create User</h2>
    <form action="admin_createuser.php" method="post">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="fname" value=""><br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value=""><br><br>
        <label for="password">Your Password Will Be Created by the System and Sent Via Email. </label><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value=""><br><br>
        <button type="submit" name="submit">Create User</button>

    </form>

</body>
</html>
