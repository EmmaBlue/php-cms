<?php

function login($username, $password)
{
    

require_once('connect.php');
  //check if username exists
  $check_exist_query = "SELECT COUNT(*) FROM tbl_user WHERE user_name = :username";
  
  // var_dump($check_exist_query);
  // $user_set = $pdo->query($check_exist_query);
  $user_set = $pdo->prepare($check_exist_query);
  $user_set->execute(
    array(
      ':username' => $username
    )
  );
    // var_dump($user_set);exit;
  if ($user_set->fetchColumn() > 0) {
    $get_user_query = "SELECT * FROM tbl_user WHERE user_pass = :psw AND user_name = :username";
    //var_dump($get_user_query);exit;
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_set->execute(
      array(
        ":psw" => $password,
        ":username" => $username
      )
    );

    while ($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)) {
      $id = $found_user['user_id'];
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $found_user['user_name'];
      // Update last_login_date to be current user's login time
      $set_login_date_query = "UPDATE tbl_user SET last_login_date = :current WHERE user_id = {:user} LIMIT 1";
      $set_login_date = $pdo->prepare($set_login_date_query);
      //var_dump($set_login_date); die;
      $set_login_date->execute(
        array(
          ":current" => 'CURRENT_TIMESTAMP()',
          ":user" => $_SESSION['user_id']
        )
      );
      $_SESSION['date'] = $found_user['last_login_date'];
      var_dump($_SESSION['date']); die;
      //Redirect to admin dashboard 
      redirect_to('index.php');
    }

    if (empty($id)){
        $message = 'Login Failed';
        return $message;
    }
    redirect_to('index.php');
  } else {
    $message = 'Login Failed';
    return $message;
  }
}