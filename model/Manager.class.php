<?php

class Manager {

	protected function connectDB() {
		require('config/database.php');
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $conn;
	}

	protected function enableFKchecks($conn) {
		$sql = 'SET FOREIGN_KEY_CHECKS=1';
		$conn->exec($sql);
	}

	protected function disableFKchecks($conn) {
		$sql = 'SET FOREIGN_KEY_CHECKS=0';
		$conn->exec($sql);
	}
}
