<?php

require_once(MODEL . "UserModel.php");

class UserManager extends Manager
{
    public function find($id)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE id =:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($res)
        {        
            $user = new UserModel();
            $user->setId($res['id']);
            $user->setUsername($res['username']);
            $user->setEmail($res['email']);
            $user->setPassword($res['password']);
        }
        return NULL;
    }

    public function findByUsername($username)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE username =:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($res)
        {        
            $user = new UserModel();
            $user->setId($res['id']);
            $user->setUsername($res['username']);
            $user->setEmail($res['email']);
            $user->setPassword($res['password']);
            return $user;
        }
        return NULL;
    }

    public function findAll()
    {
        $users = [];

        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $row)
        {
            $user = new UserModel();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $users[] = $user;
        }
        return $users;
    }

    
    public function create($user)
    {
        if (count($user->validate()) != 0)
            return NULL;
            
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
    
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("INSERT INTO camagru.user VALUES(:username, :email, :pass, NULL, NOW(), 0");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $password, PDO::PARAM_STR);
        $stmt->execute();

        $row = $this->existsByUsername($username);
        if ($row)
            return $row;
        return NULL;
    }

    public function update($object)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }

    public function exists($id)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res != false;
    }

    public function existsByUsername($username)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE username =:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        var_dump($res);
        return $res != false;
    }
}