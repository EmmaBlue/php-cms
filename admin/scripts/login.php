<?php

function login($username, $password) {
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

        // Select where DB info matches user input

        $get_user_query = "SELECT * FROM tbl_user WHERE user_pass = :psw AND user_name = :username";
        $get_user_set = $pdo->prepare($get_user_query);
        $get_user_set->execute(
          array(
            ":psw" => $password,
            ":username" => $username
          )
        );

        //While the user input matches a user in the database 
        while ($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)) {

          //Checks if user locked out 

          $locked_out_query = "SELECT * FROM tbl_user WHERE failed_login_tries >= 3 AND last_failed_login > DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND user_name = '$username'";
          $get_locked_out = $pdo->prepare($locked_out_query);
          $get_locked_out->execute (

            array (

              /*":tries" => '3',
              ":failed_time" => 'DATE_SUB(NOW(), INTERVAL 10 MINUTE)'*/

            )

          );

            // If user has been locked out 3+ times in row and it's been less than 10 mins since last try
            if ($get_locked_out->fetchColumn() > 0 ) {

              $message = 'Locked out!';
              return $message; 
            }

            else {

              //Update login attempts

    

              //Display user


              $id = $found_user['user_id'];
              $pass = $found_user['user_pass'];
              $_SESSION['user_id'] = $id;
              $_SESSION['date'] = $found_user['last_login_date'];
              $_SESSION['user_name'] = $found_user['user_name'];
              // Update last_login_date to be current user's login time
              $set_login_date_query = "UPDATE tbl_user SET last_login_date = NOW() WHERE user_id = :user LIMIT 1";
              $set_login_date = $pdo->prepare($set_login_date_query);
              $set_login_date->execute(
                array(
                  ":user" => $id
                )
              );
            //Redirect to admin dashboard 
            redirect_to('index.php');


            }
          
      }

    //If username matches but password doesn't 

    if (empty($id)){

        $_SESSION['login_fails']++;
        $login_tries = $_SESSION['login_fails'];
        var_dump($login_tries);
        //Update login tries 
        $failed_login_query="UPDATE tbl_user SET failed_login_tries = '.$login_tries.', last_failed_login = NOW() WHERE user_name = '$username'";
        $get_failed_login = $pdo->prepare($failed_login_query);
        $get_failed_login->execute(

          array (

            ":tries" => $login_tries
            
          )
        );

      $tries_left = 3 - $login_tries;
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