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
            $user->setConfRegKey($res['confRegKey']);
            $user->setRegComplete($res['regComplete']);

            return $user;
        }
        return NULL;
    }

    public function findByEmail($email)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE email =:email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($res)
        {        
            $user = new UserModel();
            $user->setId($res['id']);
            $user->setUsername($res['username']);
            $user->setEmail($res['email']);
            $user->setPassword($res['password']);
            $user->setConfRegKey($res['confRegKey']);
            $user->setRegComplete($res['regComplete']);
            
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
        $datas = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "pass" =>  $user->getPassword(),
            "confRegKey" => $user->getConfRegKey()
        ];

        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("INSERT INTO camagru.user(username, email, `password`, confRegKey, createdAt, regComplete) VALUES (:username, :email, :pass, :confRegKey, NOW(), 0)");
        $stmt->execute($datas);

        $row = $this->existsByUsername($datas['username']);
        if ($row)
            return $row;
        return NULL;
    }

    public function updatePassword($username, $password)
    {
        $pdo = $this->DatabaseConnect();
        $stmt = $pdo->prepare("UPDATE camagru.user SET password = :pass WHERE username = :username");
        $pass = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->execute([
            "pass" => $pass,
            "username" => $username
        ]);
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
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res != false;
    }

    public function existsByUsername($username)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE username = ?");
        $stmt->execute([$username]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res != false;
    }

    public function existsByEmail($email)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("SELECT * FROM camagru.user WHERE email = ?");
        $stmt->execute([$email]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res != false;
    }

    public function activate($username, $value)
    {
        $pdo = $this->databaseConnect();
        $stmt = $pdo->prepare("UPDATE camagru.user SET regComplete = :val WHERE username = :username");
        $stmt->execute([
            "val" => $value,
            "username" => $username    
        ]);
        return true;
    }
}