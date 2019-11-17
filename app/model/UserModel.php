<?php

class UserModel extends Model
{
    private $_id;
    private $_username;
    private $_email;
    private $_password;
    private $_confRegKey;
    private $_regComplete = FALSE;

    /**================================================================== GETTERS */
    
    public function getid()
    {
        return $this->_id;
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

    public function setid($id)
    {
        $this->_id = $id;
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

    public function validate()
    {
        $err = [];
        $err = array_merge($err, $this->checkUsername());
        $err = array_merge($err, $this->checkEmail());

        return $err;
    }

    /** [!] VALIDATE DOESNT GET THE USERNAME ERROR VALUE */
    public function checkUsername()
    {
        $err = [];
        if (empty($this->getUsername()))
           $err["usernameEmpty"] = "you should complete the required field";

        return $err;
    }

    /** [!] PROBLEM WITH PREG_MATCH TO RESOVLE SEND NULL INSTEAD OF ERROR*/
    public function checkEmail()
    {
        $err = [];
        if (empty($this->getEmail()))
            $err['emailEmpty'] =  "you should complete required field<br>";
        // if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", $this->getEmail()))
        //     return "email not valid<br>";
        return $err;
    }
}