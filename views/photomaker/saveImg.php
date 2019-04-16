<?php

include_once ROOT . '/models/PhotoMakerModel.php';

$manager = new PhotoMakerModel;
$manager->saveImage();
?>