<?php
    function createUser($fname, $username, $email){
        include('connect.php');
        // Generate password from the system, not from the admin
        $created_pass = create_password();
        echo $created_pass;
        /* Use this to check for decrypted system password
        var_dump($created_pass);die;
        */

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
            echo 'User account has been created! Check your email for a record of your information. If you do not login in the next 10 minutes, your account is suspended.';
            send_email($name, $email, $username, $created_pass);
            //redirect_to('index.php');
        }else {
            $message = 'Failed';
            return $message;
        }

    }

    function editUser($id, $fname, $username, $password, $email){
        include('connect.php');
        $_SESSION['user_edits']++;
        $user_edits = $_SESSION['user_edits'];
         //Insert new user into database
         $edit_user_query = 'UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password, user_email = :email, user_edits = :edits WHERE user_id = :id';
         $edit_user_set = $pdo->prepare($edit_user_query);
         $created_pass = $password;
         $edit_hash = password_hash($password, PASSWORD_DEFAULT);
         $edit_user_set->execute(
             array(
                 ':fname'=>$fname,
                 ':username'=>$username,
                 // Encrypt password
                 ':password' => $edit_hash,
                 ':email'=>$email,
                 ':edits'=>$user_edits,
                 ':id'=>$id
             )
         );

        // $edit_user = $edit_user_set->rowCount();
        // var_dump($edit_user);die;

         /*if($edit_user_set->rowCount()){
             redirect_to('index.php');
         } else {
             $message = 'Guess you got canned...';
             return $message;
         }*/

         // If new user has been inserted into database, alert user and send them an email
         if($edit_user_set->rowCount()){
             //echo 'User account has been updated!';
             //Update this so it gives them the updated password
             //send_email($name, $email, $username, $created_pass);
             redirect_to('index.php');
         }else {
             $message = 'Failed';
             return $message;
         }


    }

    function deleteUser($id) {
        include('connect.php');
         $delete_user_query = 'DELETE FROM tbl_user WHERE user_id = :id';
         $delete_user_set = $pdo->prepare($delete_user_query);
         $delete_user_set->execute(
             array(
                    ":id"=> $id
             )
            );

        if($delete_user_set->rowCount()){
            redirect_to('../index.php');
        } else {
            $message = 'Error with deleting...';
            return $message;
        }


    }