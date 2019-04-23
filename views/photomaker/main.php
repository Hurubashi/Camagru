
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

<?php

include_once (ROOT . '/views/header.php');

if (!isset($_SESSION['username'], $_SESSION['id'])) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/confirmation');
}

?>

<body>

<div class="mainFrame">
<div class="videoFrame frameSizeClass" id="div" >
    <video id="video"autoplay></video>
</div>

    <div class="actionButton" id="snap"> Make Photo </div>
    <div class="actionButton" id="clear"> Clear </div>

    <select id="photo-filter">
        <option value="none">Normal</option>
        <option value="grayscale(100%)">Grayscale</option>
        <option value="sepia(100%)">Sepia</option>
        <option value="invert(100%)">Invert</option>
        <option value="hue-rotate(90deg)">Hue</option>
        <option value="blur(10px)">Blur</option>
        <option value="contrast(200%)">Contrast</option>
    </select>
    <input type="file" id="imageLoader" name="imageLoader"/>
    <button onclick="switchToVideo()">Return Video</button>
    <canvas id="imageCanvas" hidden></canvas>
    <?php include_once "slider.php"?>

    <div class="photoFrame frameSizeClass" id="canvasDiv">
        <canvas id="canvas"></canvas>
    </div>
    <div class="actionButton" id="save"> Save Photo </div>
</div>

<script src="/components/js/photoMaker.js"></script>
<script>

</script>
</body>

</html>