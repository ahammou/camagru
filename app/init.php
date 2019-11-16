<?php

require_once(CORE . "App.php");
require_once(CORE . "Controller.php");
require_once(CORE . "View.php");
require_once(CORE . "Model.php");
require_once(CONFIG . "setup.php");

$db = new Setup();
$db->createDatabase();