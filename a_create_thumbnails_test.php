<?php
/* code to copy image file form originals folder uploaded to,
then reduce size to thumbnail,
then save in thumbnail directory */

function createthumbs ($origImagePath,$tnImagePath,$fname,$thumbWidth){
    // 1. open the originals directory
        $dir = opendir($origImagePath);
        
    // 2. Find the original imaeg file
    //$fname = "1397841364-KamalProfPic1.jpg";
        
        echo "Creating thumbnail for {$origImagePath}{$fname} <br />";
        
    // 3. load image and get image size
        $img = imagecreatefromjpeg( "{$origImagePath}{$fname}" );
        $width = imagesx( $img );
        $height = imagesy( $img );

    // 4. calculate thumbnail size
        $new_width = $thumbWidth;
        $new_height = floor( $height * ( $thumbWidth / $width ) );

    // 5. create a new temporary image
        $tmp_img = imagecreatetruecolor( $new_width, $new_height );

     // 6. copy and resize old image into new image 
        imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

    // 7. save thumbnail into a file
        imagejpeg( $tmp_img, "{$tnImagePath}{$fname}" );
        
    // 8. close the directory
        closedir( $dir );       
}

createthumbs("assets/images/uploads/profpic/originals/","assets/images/uploads/profpic/thumb/","1397841364-KamalProfPic1.jpg",50);

?>