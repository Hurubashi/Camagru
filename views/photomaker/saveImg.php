<?php

    $imgData = str_replace(' ','+',$_POST['image']);
    $imgData =  substr($imgData,strpos($imgData,",")+1);
    $imgData = base64_decode($imgData);
// Path where the image is going to be saved
    $filename = uniqid(rand(), true) . '.png';
    $filePath = '/components/photoLibrary/' . $filename;
// Write $imgData into the image file

    echo "test";
    $file = fopen( (ROOT . $filePath), 'w');
    fwrite($file, $imgData);
    fclose($file);

    session_start();
    include_once ROOT . '/models/PostingManager.php';
    $manager = new PostingManager;
    $manager->saveImage($_SESSION['id'], $_SESSION['username'], $filePath);
?>