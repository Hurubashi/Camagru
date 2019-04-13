<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
    <link href="/components/css/photoPost.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<?php

$i = 0;

while ($i < 10) {
    echo
    "<div class='photoPost'>
        <img class='photo' src='/components/images/temp2.png'>
        <div class='postInfo'>
            Pic name
            <br>
            01.07.2017
            <img src='/components/images/like.svg' style='width: 20px; height: 20px;'> 5
            <img src='/components/images/chat.svg' style='width: 20px; height: 20px;'> 2
        </div>
    </div>";
    $i += 1;
}


?>
</div>

</body>

</html>
