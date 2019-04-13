
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
// ************************************************************
var video = document.getElementById('video');
var videoDiv = document.getElementById('div');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var photoDone = false;


// Make photo
// ************************************************************
document.getElementById("snap").addEventListener("click", function() {

    photoDone = true;
    canvas.width = videoDiv.offsetWidth;
    canvas.height = videoDiv.offsetHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    var addedImages = document.querySelectorAll('.draggable');
    for (const elem of addedImages) {
        console.log('elem:', elem.style.left, elem.style.top);
        console.log('videoDiv:', videoDiv.offsetWidth, videoDiv.offsetHeight);

        context.drawImage(elem, parseInt(elem.style.left, 10), parseInt(elem.style.top, 10), elem.width, elem.height);
    }
});


// Save Photo (Make POST request that sends picture)
// ************************************************************
document.getElementById("save").addEventListener("click", function() {

    if (photoDone == false) {
        return;
    }
    var canvasData = canvas.toDataURL('image/png');
    var request = new XMLHttpRequest();

    request.open("POST", 'saveImg');
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("image=" + canvasData);
});


// Clear videoFrame from child elements except Video
// ************************************************************
document.getElementById("clear").addEventListener("click", function() {
    while (videoDiv.firstChild) {
        videoDiv.removeChild(videoDiv.firstChild);
    }
    videoDiv.appendChild(video);
});


// Manage drag and drop
// ************************************************************
var dragged = undefined;
const assetImages = document.querySelectorAll('.assetImg');

for(const elem of assetImages) {
    elem.addEventListener("click", function() {
        var image = new Image();
        image.src = elem.src;
        image.className = 'draggable';
        image.draggable = true;
        image.style.top = 10 + 'px';
        image.style.left = 10 + 'px';
        videoDiv.appendChild(image);
    });
}

var startX = undefined;
var startY = undefined;

document.addEventListener('dragstart', function (event) {
    dragged = event.target;
    startX = event.pageX;
    startY = event.pageY;
}, false);

document.addEventListener("dragover", function( event ) {
    event.preventDefault();
}, false);

document.addEventListener("drop", function( event ) {

    // prevent default action (open as link for some elements)
    event.preventDefault();

    // move dragged elem to the selected drop target
    if ((event.target.id == "video" || dragged.className == 'draggable') && dragged.className == 'draggable') {
        var shiftX = dragged.offsetLeft + event.pageX - startX;
        var shiftY = dragged.offsetTop + event.pageY - startY;

        if ((shiftX + dragged.offsetWidth) > videoDiv.offsetWidth) {
            dragged.style.left = videoDiv.offsetWidth - dragged.offsetWidth + 'px';
        } else if (shiftX <= 0) {
            dragged.style.left = 0 + 'px';
        } else {
            dragged.style.left = shiftX + 'px';
        }

        if ((shiftY + dragged.offsetHeight) > videoDiv.offsetHeight) {
            dragged.style.top = videoDiv.offsetHeight - dragged.offsetHeight + 'px';
        } else if (shiftY <= 0) {
            dragged.style.top = 0 + 'px';
        } else {
            dragged.style.top = shiftY +'px';
        }

    }
}, false);





