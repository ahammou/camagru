<?php

class Setup
{
    public function __construct()
    {
        
    }

    public function createDatabase() {
        require (CONFIG . "database.php");
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q =    'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                SET time_zone = "+01:00";
                CREATE DATABASE IF NOT EXISTS ' . $DB_NAME .
                ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;' .
                'USE ' . $DB_NAME . ';';
        $pdo->exec($q);
        $q = file_get_contents(CONFIG . "tables.sql");
        $pdo->exec($q);
        unset($pdo);
    }

    public function dropDatabase() {
        require (CONFIG . "database.php");
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE IF EXISTS " . $DB_NAME . ";";
		$pdo->exec($sql);

        echo "database dropped <br>";
        unset($pdo);
    }

    public function recreateDatabase()
    {
        $this->dropDatabase();
        $this->createDatabase();
    }
}


