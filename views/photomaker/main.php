<?php

if (!isset($_SESSION['username'], $_SESSION['id'])) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/confirmation');
}

?>

<html>
<head>
    <title>Camera Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
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