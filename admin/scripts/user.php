<?php 
    function createUser($fname, $username, $password, $email){
        include('connect.php');  
        // Generate password from the system, not from the admin
        $created_pass = create_password();
        
        $pass_hash = password_hash($created_pass, PASSWORD_DEFAULT);
        //Insert new user into database
        $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email) VALUES(:fname, :username, :password, :email)';
        $create_user_set = $pdo->prepare($create_user_query);
        $create_user_set->execute(
            array(
                ':fname'=>$fname,
                ':username'=>$username,
                // Encrypt password
                ':password' => $pass_hash,
                ':email'=>$email
            )
        );

        // If new user has been inserted into database, alert user and send them an email
        if($create_user_set->rowCount()){
            echo 'User account has been created! Check your email for a record of your information.';
            send_email($name, $email, $username, $created_pass);
            //redirect_to('index.php');
        }else {
            $message = 'Failed';
            return $message;
        }

    }