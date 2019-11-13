<?php

class User extends Model
{
    private $_userName = '';
    private $_email = '';
    private $_password;
    private $_confRegKey;
    private $_confRegistration = FALSE;

    public function __construct()
    {
        # code...
    }

    /**================================================================== GETTERS */
    
    public function getUserName()
    {
        return $this->_userName;
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

    public function getConfRegistration()
    {
        return $this->_confRegistration;
    }

    /**================================================================== SETTERS */
}