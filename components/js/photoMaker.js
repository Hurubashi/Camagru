
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
const video = document.getElementById('video'),
    videoDiv = document.getElementById('div'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d');

var photoDone = false,
    filter = 'none',
    imgSrc = video;

// Make photo
// ************************************************************
document.getElementById("snap")
    .addEventListener("click", function() {

    photoDone = true;
    canvas.width = videoDiv.offsetWidth;
    canvas.height = videoDiv.offsetHeight;
    context.filter = filter;
    context.drawImage(imgSrc, 0, 0, canvas.width, canvas.height);

    let addedImages = document.querySelectorAll('.draggable');
    for (const elem of addedImages) {
        context.drawImage(elem, parseInt(elem.style.left, 10),
            parseInt(elem.style.top, 10), elem.width, elem.height);
    }
});


// Photo Filer
// ************************************************************
document.getElementById('photo-filter')
    .addEventListener('change', function (e) {
        // Set filter to chosen option and apply it to video
        filter = e.target.value;
        video.style.filter = filter;
        imgSrc.style.filter = filter;
        let addedImages = document.querySelectorAll('.draggable');
        for (const elem of addedImages) {
            elem.style.filter = filter;
        }
        e.preventDefault();
    });


// Save Photo (Make POST request that sends picture)
// ************************************************************
document.getElementById("save")
    .addEventListener("click", function() {

    if (photoDone == false) {
        return;
    }

    const imgUrl = canvas.toDataURL('image/png');
    let request = new XMLHttpRequest();

    request.open("POST", 'saveImg');
    request.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    request.send("image=" + imgUrl);
});


// Clear videoFrame from child elements except Video
// ************************************************************
document.getElementById("clear")
    .addEventListener("click", function() {

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
        image.style.filter = filter;
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
    if ((event.target.id == "video" || dragged.className == 'draggable')
        && dragged.className == 'draggable')
    {
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

//*** File Uploader make canvas with uploaded file imgSrc
//***********************************************************

var imageLoader = document.getElementById('imageLoader');
imageLoader.addEventListener('change', handleImage, false);
var uploadedImgCanvas = document.getElementById('imageCanvas');
var ctx = uploadedImgCanvas.getContext('2d');


function handleImage(e){
    var img = new Image();
    var reader = new FileReader();
    reader.onload = function(event){
        img.onload = function(){
            uploadedImgCanvas.width = img.width;
            uploadedImgCanvas.height = img.height;
            img.style.filter = filter;
            ctx.drawImage(img,0,0);
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
    imgSrc = uploadedImgCanvas;
    imgSrc.style.filter = filter;
    videoDiv.appendChild(imgSrc);
    video.hidden = true;
    imgSrc.hidden = false;
}

// Switch to imgSrc back video
function switchToVideo() {
    imgSrc.hidden = true;
    video.hidden = false;
    imgSrc = video;
}
