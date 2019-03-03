<?php

function login($username, $password, $ip) {
    require_once('connect.php');
    //check if username exists
    $check_exist_query = "SELECT COUNT(*) FROM tbl_user WHERE user_name = :username";
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
      array(
        ':username' => $username
      )
    );

    // If there is at least 1 user in database
    if ($user_set->fetchColumn() > 0) {

       //Get encrypted password from database
        $get_user_hash = 'SELECT user_pass FROM tbl_user WHERE user_name = :username';
        $user_hash_set = $pdo->prepare($get_user_hash);
        $user_hash_set->execute(
          array(
            ':username' => $username
          )
        );
        $user_hash = $user_hash_set->fetchColumn();
        $hash_pass = password_verify($password, $user_hash);
       // var_dump($password);die;
        // Select where DB info matches user input

        $get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username';
        $get_user_set = $pdo->prepare($get_user_query);
        //If encrypted DB password matches user input
        if($hash_pass){
          $get_user_set->execute(
            array(
              ':username'=>$username
            )
          );
        }

        //While the user input matches a user in the database
        while ($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)) {

          //Checks if user locked out

          $locked_out_query = "SELECT * FROM tbl_user WHERE failed_login_tries >= 3 AND last_failed_login > DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND user_name = :user";
          $get_locked_out = $pdo->prepare($locked_out_query);
          $get_locked_out->execute (
            array (
              ":user" => $username
            )

          );

          //Checks if user is logging into account too late after account creation

          $suspended_account_query="SELECT * FROM tbl_user WHERE user_date < DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND last_login_date = '0000-00-00 00:00:00' AND user_name = :user";
          $get_suspended_account = $pdo->prepare($suspended_account_query);
          $get_suspended_account->execute(

            array (

              ":user" => $username

            )
          );

            // If user has been locked out 3+ times in row and it's been less than 10 mins since last try
            if ($get_locked_out->fetchColumn() > 0 ) {

              //var_dump($password);
              $message = 'Locked out!';
              return $message;
            }

            // If user is logging into account longer than 10 minutes after account created

            else if ($get_suspended_account->fetchColumn() > 0) {

              $message = 'You logged in too late after your account was created! Account suspended. Ask the admin to make you another account.';
              return $message;

            }

            else if ($get_locked_out->fetchColumn() <=0  && $get_suspended_account->fetchColumn() <= 0)  {

                  //Update login attempts

                  //Display user


                  $id = $found_user['user_id'];
                  $pass = $found_user['user_pass'];
                  $_SESSION['user_id'] = $id;
                  $_SESSION['date'] = $found_user['last_login_date'];
                  $_SESSION['user_name'] = $found_user['user_name'];
                  // Update last_login_date to be current user's login time and update login tries
                  $set_login_query = "UPDATE tbl_user SET last_login_date = NOW() WHERE user_id = :user LIMIT 1";
                  $set_login = $pdo->prepare($set_login_query);
                  $set_login->execute(
                    array(
                      ":user" => $id
                    )
                  );

                  //Update ip to be current user's ip address
                  $set_ip_query = 'UPDATE tbl_user SET user_ip = :ip WHERE user_id = :id';
                  $set_ip = $pdo->prepare($set_ip_query);
                  $set_ip->execute(
                    array(
                      ':ip' => $ip,
                      ':id' => $id
                    )
                  );
                //Redirect
                $check_first_login_query = "SELECT * FROM tbl_user WHERE last_login_date = '0000-00-00 00:00:00' AND user_name = :user";
                $check_first_login = $pdo->prepare($check_first_login_query);
                $check_first_login->execute (
                  array (
                    ":user" => $username
                  )

                );

                $check_if_edited_query = "SELECT * FROM tbl_user WHERE user_edits = 0 AND user_name = :user";
                $check_if_edited = $pdo->prepare($check_if_edited_query);
                $check_if_edited->execute (
                  array (
                    ":user" => $username
                  )

                );

                //If this is the first login or if user has edited their account yet
                if ($check_first_login->fetchColumn() > 0 ||$check_if_edited->fetchColumn() > 0 )  {
                  redirect_to('admin_edituser.php');

                }
                else {

                  redirect_to('index.php');

                }


                }

            else {

              $message = 'Locked out!';
              return $message;


            }

      }

    //If username matches but password doesn't

    if (empty($id)){

        $_SESSION['login_fails']++;
        $login_fails = $_SESSION['login_fails'];
        //Update login tries
        $failed_login_query="UPDATE tbl_user SET failed_login_tries = :tries, last_failed_login = NOW() WHERE user_name = :user";
        $get_failed_login = $pdo->prepare($failed_login_query);
        $get_failed_login->execute(

          array (

            ":tries" => $login_fails,
            ":user" => $username

          )
        );

      $tries_left = 3 - $login_fails;
      $message = 'Login Failed. You have '.$tries_left.' more tries before being locked.';
      if ($tries_left <= 0) {

        $message = 'Locked out!';

      }
      return $message;
    }
    redirect_to('index.php');
  }

  else {
      $message = 'Login Failed.';

      return $message;
  }
}