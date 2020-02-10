<?php
foreach ($posts as $p) {
?>
    <div class="post thumb">
        <img src="<?= $p['thumb'] ?>" alt="Thumb">
    </div>
<?php
}
?>