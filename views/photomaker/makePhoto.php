<!DOCTYPE html>
<html>
<head>
    <title>Camera Page</title>
</head>

<body>

<canvas id="canvas" width="640" height="480"></canvas>
<video id="video" width="640" height="480" autoplay></video>
<button id="snap">Snap Photo</button>
<button id="save">Save Photo</button>
<p id="response"></p>

<script>

    // Grab elements, create settings, etc.
    var video = document.getElementById('video');

    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            // video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
            video.play();
        });
    }
    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');

    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });

    document.getElementById("save").addEventListener("click", function() {

        var canvasData = canvas.toDataURL('image/png');

        console.log("save");

        var request = new XMLHttpRequest();

        request.onload = function() {
            const reponse = document.getElementById("response");
            reponse.innerHTML = this.responseText;
            console.log("onload");
        }

        request.open("POST", 'saveImg');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("image=" + canvasData);

    });

</script>


<?php
include_once 'dragAndDrop.php';

//if ($_POST) {
//
//}
?>
</body>

</html>