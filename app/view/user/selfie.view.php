<?php include VIEW . 'header.inc.php'; ?>

<h1>Take a picture of yourself</h1>

<div class="video-wrap">
    <video id="video" playsinline autoplay></video>
</div>

<!-- Trigger canvas web API -->
<div>
    <button id="snap" class="btn indigo lighten-2">Capture</button>
    <form action="selfie/upload" method="post" enctype="multipart/form-data">
        Select an image to upload: 
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>

<!-- Webcam video snapshot -->
<canvas id="canvas" width="640" height="480"></canvas>

<script type="text/javascript">
'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    width: 640, height: 480
  }
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
snap.addEventListener("click", function() {
	context.drawImage(video, 0, 0, 640, 480);
});
</script>

<?php include VIEW . 'footer.inc.php'; ?>