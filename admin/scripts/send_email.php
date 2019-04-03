<?php
function send_email($first_name, $user_email, $user_name, $user_password) {
    //Take info from user input and send an email with input info
    $name = $first_name;
    $email = $user_email;
    $subject = 'subject: Your Account Info.';
    $message = 'message: Your account has been created! Your username is'.$user_name.' Your password is:'.$user_password.' Go to movies.com to login.';
    $to = $user_email;
    $headers = 'From: noreply@movies.com' . '\r\n';
    mail($to, $subject, $message, $headers);
}