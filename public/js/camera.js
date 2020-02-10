(function() {
    var width = 0;
    var height = 300;
    var streaming = false;
    var div = null;
    var frame = null;
    var photo = null;
    var video = null;
    var canvas = null;
    var frames = null;
    var savebtn = null;
    var uploadbtn = null;
    var capturebtn = null;

    function takepicture() {
        var context = canvas.getContext('2d');
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);
            photo.setAttribute('src', canvas.toDataURL('image/jpeg'));
            context.drawImage(frame, 0, 0, width, height);

            canvas.style.display = "block";
            claimer.style.display = "block";
            savebtn.style.display = "block";
            capturebtn.innerHTML = "Recapture";
        }
    }

    function startup() {
        div = document.getElementById('camera');
        frame = document.getElementById('frame');
        photo = document.getElementById('photo');
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        frames = document.getElementById('frames');
        claimer = document.getElementById('claimer');
        savebtn = document.getElementById('savebtn');
        uploadbtn = document.getElementById('uploadbtn');
        capturebtn = document.getElementById('capturebtn');

        navigator.mediaDevices.getUserMedia({video: true, audio: false})
        .then(function(stream) {
            div.style.display = "block";
            video.style.display = "block";
            frames.style.display = "block";
            capturebtn.style.display = "block";
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            uploadbtn.style.display = "block";
            console.log("An error occurred: " + err);
        });

        video.addEventListener('canplay', function(){
            if (!streaming) {
                width = video.videoWidth / (video.videoHeight/height);
                if (isNaN(width)) {
                    width = height * (4/3);
                }
                
                frame.setAttribute('width', width);
                frame.setAttribute('height', height);
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        }, false);

        capturebtn.addEventListener('click', function(ev){
            takepicture();
            ev.preventDefault();
        }, false);
    }

    window.addEventListener('load', startup, false);
})();

function upload() {
    document.getElementById('file').click();
};

document.getElementById('file').onchange = function() {
    var canvas = document.getElementById('uploadcanvas');
    var photo = document.getElementById('uploadedphoto');
    canvas.style.display = "block";
    document.getElementById('frames').style.display = "block";

    var img = new Image();
    img.onload = function() {
        var ctx = canvas.getContext('2d');
        var width = canvas.width;
        var height = canvas.height;
        
        ctx.drawImage(this, 0,0, width, height);
        photo.setAttribute('src', canvas.toDataURL('image/jpeg'));
    }
    img.onerror = function() {
        console.error("The provided file couldn't be loaded as an Image media!");
    }
    img.src = URL.createObjectURL(this.files[0]);

    document.getElementById('uploadbtn').innerHTML = "Change";
    document.getElementById('savebtn').style.display = "block";
};

function saveImg() {
    var image = document.getElementById('uploadedphoto');
    if (!image.src)
        image = document.getElementById('photo');
    document.getElementById('sendData').value = image.getAttribute('src');
    var fd = new FormData(document.forms['sendForm']);
    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'controller/backend/saveImg.php');
    xhr.onload = function() {};
    xhr.send(fd);
}