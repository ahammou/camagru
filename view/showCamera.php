<?php
ob_start();

$title = "Camagru - Camera";
?>
<section id="cameraSection">
    <div id="blockcamera">
        <div id="camera">
            <video id="video" style="display:none;">Video stream not available.</video>
            <canvas id="uploadcanvas" class="uploaded" style="display:none;">
                <img id="uploadedphoto" alt="The captured photo will appear here.">
            </canvas>
            <img id="frame" class="uploaded" style="display:none;">
            <div id="buttons">
                <form name="sendForm" method="post">
                    <div id="frames" style="display:none;">
<?php                   foreach($frames as $f) { ?>
                            <input type="radio" name="frame" value="<?= $f['fr_path'] ?>"
                                onclick="document.getElementById('savebtn').disabled = false;
                                        document.getElementById('capturebtn').disabled = false;
                                        document.getElementById('frame').style.display = 'block';
                                    document.getElementById('frame').src = '<?= $f['fr_path'] ?>';">
                            <img class="framePreview" src="<?= $f['fr_path'] ?>" width="50px">
<?php                   } ?>
                    </div>
                    <input type="hidden" id="sendData" name="image">
                    <button id="SAVEbtn" onclick="saveImg()" style="display:none;">
                        Save
                    </button>
                </form>
                <div style="display:flex; align-items:baseline;">
                    <button id="savebtn" class="mainbtn" style="display:none;" disabled
                        onclick="document.getElementById('SAVEbtn').click();">
                        Save
                    </button>
                    <button id="capturebtn" style="display:none;" disabled
                        onclick="document.getElementById('picture').style.display = 'block';">
                            Capture
                    </button>
                    <input type="file" id="file" style="display:none;" accept="image/*">
                    <button id="uploadbtn" value="Upload" onclick="upload();"
                        style="display:none;">Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="picture" style="display:none;">
        <canvas id="canvas" style="display:none;">
            <img id="photo" alt="The captured photo will appear here.">
        </canvas>
        <p id="claimer" style="display:none;">
            If saved image isn't automatically added in the previous posts part, there was a problem!
        </p>
    </div>
    <aside id="thumbnails">
        <p>Previous posts</p>
        <div id="thumbs" class="posts">
<?php
if (!empty($posts)) {
    $load = TRUE;

    require_once('includes/userThumbs.php');
?>
        <script src="public/jquery/infScroll.js"></script>
<?php
}
?>
        </div>
<?php
    if (isset($load)) {
?>
        <img id="loader" src="public/images/icons/loader.svg">
<?php
    }
?>
    </aside>
</section>
<script src="public/js/camera.js"></script>
<?php
$body = ob_get_clean();

require('template.php');
?>