<?php include VIEW . 'header.inc.php'; ?>

<h1>home page</h1>
<h2>hello <?= $data['user']->getUsername() ?></h2>
<h3>and here is the <?= $data['user']->getEmail() ?></h3>

<?php include VIEW . 'footer.inc.php'; ?>