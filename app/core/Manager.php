<?php

abstract class Manager
{
    protected function databaseConnect()
    {
        require(CONFIG . "database.php");

        try {
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "database connected";
        } catch (PDOException $e) {
            $e->getMessage();
            exit();
        }

        return $pdo;
    }
    public abstract function find($id);
    public abstract function findAll();
    public abstract function create($object);
    public abstract function update($object);
    public abstract function delete($id);
}
