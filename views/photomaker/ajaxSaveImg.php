<?php

include_once ROOT . '/models/PhotoMakerModel.php';

session_start();
$manager = new PhotoMakerModel;
$manager->saveImage();
?>