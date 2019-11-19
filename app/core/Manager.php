<?php

abstract class Manager
{
    protected function databaseConnect()
    {
        require(CONFIG . "database.php");

        try {
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
           echo "database error = " . $e->getMessage();
        }

        return $pdo;
    }
    public abstract function find($id);
    public abstract function findAll();
    public abstract function create($object);
    public abstract function update($object);
    public abstract function delete($id);
}
