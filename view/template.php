<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title id="title"><?= $title ?></title>
		<link href="public/css/style.css" rel="stylesheet">
		<!-- <link rel="shortcut icon" href="public/images/icons/favicon.ico"> -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="public/jquery/inview/jquery.inview.js"></script>
	</head>

	<body>
	<div class="wrapper">
<?php	
		if (!isset($_SESSION['auth']) && $_SESSION['page'] !== "resetPsw"
			&& $_SESSION['page'] !== "forgotPsw") {
			include('includes/loginForm.php');
			include('includes/signupForm.php');
?>
			<script src="public/js/template.js"></script>
<?php	} ?>
		<header>
			<!-- <div class="logo">
			<a href="index.php?page=home">
				<img class="logo" src="public/images/icons/logo.png" alt="Camagru">
			</a>
			</div> -->
<?php	if (isset($_SESSION['auth'])) { ?>
			<div class="flexcontainer">
				<nav class="left-nav">
					<a class="nav button iconColor" href="index.php?page=home&action=home">Home</a>
					<a class="nav button iconColor" href="index.php?page=camera">Camera</a>
				</nav>
				<nav class="right-nav">
					<a class="nav button iconColor" href="index.php?page=profile">Profile</a>
					<a class="nav button iconColor" href="index.php?page=home&action=logout">Logout</a>
				</nav>
			</div>
<?php	} elseif ($_SESSION['page'] !== "resetPsw") { ?>
			<nav class="right-nav">
				<button class="bold" onclick="showLoginForm()">Log In</button>
				<button class="bold" onclick="showSignupForm()">Sign Up</button>
    		</nav>
<?php	} ?>
		</header>
		<hr>
		<div class="body">
			<?= $body ?>
<?php	if (isset($loader)) { ?>
			<img id="loader" src="public/images/icons/loader.svg">
<?php	} ?>
		</div>
	</div>
	<footer>
		<address>
			Camagru, first web project at 19 | Made by <b>ahammou-</b>.
		</address>
	</footer>
	<script>
			window.addEventListener('focus', activeTab);
			window.addEventListener('blur', inactiveTab);

			function inactiveTab() {
				document.getElementById('title').innerHTML = "Come back, I miss you!";
			}

			function activeTab() {
				document.getElementById('title').innerHTML = "<?= $title ?>";
			}
	</script>
<?php
	if ((!$_SESSION['auth'] && $_SESSION['page'] !== "message")
							|| $_SESSION['page'] === "profile") { 
?>
		<script src="public/js/validation.js"></script>
<?php
	}
?>
	</body>
</html>