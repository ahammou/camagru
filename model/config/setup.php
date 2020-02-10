<?php

class Setup {

	public function createDB() {
		require('database.php');
		$conn = new PDO($db_dsn, $DB_USER, $DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
				SET time_zone = "+01:00";
				CREATE DATABASE IF NOT EXISTS ' . $DB_NAME .
				' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;' .
				'USE ' . $DB_NAME . ';';
		$conn->exec($sql);
		$sql = file_get_contents("model/config/tables.sql");
		$conn->exec($sql);

		$conn = NULL;
		$_SESSION['database'] = TRUE;
	}

	public function dropDB() {
		require('database.php');
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE IF EXISTS " . $DB_NAME . ";";
		$conn->exec($sql);

		$conn = NULL;
		$_SESSION['database'] = FALSE;
	}

	public function recreateDB() {
		$this->dropDB();
		$this->createDB();
	}
}