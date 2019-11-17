<?php

abstract class Manager
{
    public function databaseConnect()
    {
        require(CONFIG . "database.php");

        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public function findAll()
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;
    }
}
