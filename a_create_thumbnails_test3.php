<?php

$image = new Imagick('./assets/images/profpic/originals/image.png');
//$new_height = floor( $height * ( $thumbWidth / $width ) )
$image->cropThumbnailImage(100,100);
$image->writeImage( './assets/images/profpic/originals/image_thumb.png' );



?>
