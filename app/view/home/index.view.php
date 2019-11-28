<?php include VIEW . 'header.inc.php'; ?>

<h1>home page</h1>
<h2>hello <?= isset($_SESSION['username']) ? $_SESSION['username'] : "" ?></h2>
<h3>and here is your email <?= isset($_SESSION['email']) ? $_SESSION['email'] : "" ?></h3>

<?php include VIEW . 'footer.inc.php'; ?>