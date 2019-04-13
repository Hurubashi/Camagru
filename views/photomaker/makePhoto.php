<?php
session_start();

if (!isset($_SESSION['username'], $_SESSION['id'])) {
    echo 'YOU Need To LOG IN, FUCKER';
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/user/confirmation');
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Camera Page</title>
    <link rel="stylesheet" href="/components/css/makePhoto.css">
</head>

<body>

<div class="mainFrame">
<div class="videoFrame frameSizeClass" id="div" >
    <video id="video"autoplay></video>
</div>
    <div class="actionButton" id="snap"> Make Photo </div>
    <div class="actionButton" id="clear"> Clear </div>

    <?php include_once "slider.php"?>

    <div class="photoFrame frameSizeClass" id="canvasDiv">
        <canvas id="canvas"></canvas>
    </div>

    <div class="actionButton" id="save"> Save Photo </div>
</div>


<script src="/components/js/photoMaker.js"></script>

</body>

</html>