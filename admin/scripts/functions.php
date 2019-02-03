<?php

// Redirects user to right location

function redirect_to($location) {
  if($location != NULL ) {
    header('Location: '.$location);
    exit();
  }
}
