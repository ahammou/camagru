<?php

if (!isset($_SESSION['database'])) {
    require_once('model/config/setup.php');

    $setup = new Setup;
    $setup->createDB();
}
showHome();