<?php

class UserModel extends Model
{
    private $_userId;
    private $_username = '';
    private $_email = '';
    private $_password;
    private $_confRegKey;
    private $_regComplete = FALSE;

    /**================================================================== GETTERS */
    
    public function getUserId()
    {
        return $this->_userId;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getConfRegKey()
    {
        return $this->_confRegKey;
    }

    public function getRegComplete()
    {
        return $this->_regComplete;
    }

    /**================================================================== SETTERS */

    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setConfRegKey($confRegKey)
    {
        $this->_confRegKey = $confRegKey;
    }

    public function setRegComplete($regComplete)
    {
        $this->_regComplete = $regComplete;
    }

    /**================================================================== VALIDATION METHOD */

    public function validate($data, $error)
    {
        $err = [];
        $err = ["username" => $this->checkUsername($data, $error)];
        $err = ["email" => $this->checkEmail($data, $error)];
        return $err;
    }

    public function checkUsername($data, $error)
    {
        if (empty($this->getUsername()))
            $error = "you should complete required field<br>";
        else if ($this->getUsername() == $data['userName'])
            $error = "username already taken<br>";
        return $error;
    }

    public function checkEmail($data, $error)
    {
        if (empty($this->getEmail()))
               $error = "you should complete required field<br>";
        else if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->getEmail()))
        {
            if ($this->getEmail() == $data['email'])
                $error = "email already exists<br>";
        }
        else
            $error = "email not valid<br>";
        return $error;
    }
}