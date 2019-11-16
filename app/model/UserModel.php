<?php

class User extends Model
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

    /**================================================================== OTHER METHOD USING DB */

    public function checkIfExists($email)
    {
        # code...
    }

}