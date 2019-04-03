<?php

function create_password(){
 // Generate random password
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $count = strlen($chars);
  $system_pass = '';
  for($i = 0; $i < $count; $i++){
    $system_pass .= $chars[mt_rand(0, $count-1)];
  }
  return $system_pass;

}