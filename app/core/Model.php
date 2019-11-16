<?php

class Model 
{
    protected $database;

    public function __construct()
    {
        $this->databaseConnect();
    }

    public function databaseConnect()
    {
        require(CONFIG . "database.php");

        try {

            require (CONFIG . "database.php");
		    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Problem is " . $e->getMessage();
        }
    }
}
