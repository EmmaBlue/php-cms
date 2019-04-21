<?php

// Redirects user to right location

function redirect_to($location) {
  if($location != NULL ) {
    header('Location: '.$location);
    exit();
  }
}

// Resizes image
function resize($imageID, $width, $height)
{
  $twidth = 350;
  $theight = 350;
  //creates new image with theight and twidth specs
  $targetLayer = imagecreatetruecolor($twidth, $theight);
  //reduces size of image
  imagecopyresampled($targetLayer, $imageID, 0, 0, 0, 0, $twidth, $theight, $width, $height);
  return $targetLayer;
}
