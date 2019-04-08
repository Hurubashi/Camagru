<?php

foreach ($_POST as $post_var) {

    $imgData = str_replace(' ','+',$_POST['image']);
    $imgData =  substr($imgData,strpos($imgData,",")+1);
    $imgData = base64_decode($imgData);
// Path where the image is going to be saved
    $filename = uniqid(rand(), true) . '.png';
    $filePath = ROOT. '/components/images/' . $filename;
// Write $imgData into the image file
    $file = fopen($filePath, 'w');
    fwrite($file, $imgData);
    fclose($file);
}

?>