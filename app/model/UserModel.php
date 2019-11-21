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
    
    public function getId()
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
        $res = [];
        $count = 0;

        $check = [
            "username" => $this->checkUsername(),
            "email" => $this->checkEmail(),
            "password" => $this->checkPassword()
        ];
 
        $res = array_merge($res, $check);
        return $res;
    }

    public function checkUsername()
    {
        $err = [];
        if (empty($this->getUsername()))
            return $err["username"] = "username required";
        if (!preg_match_all("/^(?=.{5,32}$)(?!.*((\.\.)|(\-\-)|(\_\_)))(?!.*\.$)[a-z][a-z0-9\.\-\_]*$/i", $this->getUsername()))
            return $err["username"] = "the username cant't contain dots or 2 consecutive separators and must have between 5 and 32 characters";
        return NULL;
    }

    public function checkEmail()
    {
        $err = [];
        if (empty($this->getEmail()))
            return $err['email'] =  "email required";
        if (!preg_match_all("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z0-9]+$/i", $this->getEmail()))
            return "email not valid<br>";
        return NULL;
    }

    public function checkPassword()
    {
        $err = [];
        if (empty($this->getPassword()))        
            return $err['password'] = "password required";
        if (!preg_match_all("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,64}$/", $this->getPassword()))
            return "The password must contain 1 special character, 1 Uppercase, 1 number and at least have between 8 and 64 characters";
        return NULL;
    }

    function sendVerificationEmail($toAddr, $toUsername, $url) {
        $subject = "[CAMAGRU] - Email verification";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <ahammou-@student.s19.be>' . "\r\n";
        $message = "
        <html>
          <head>
            <title>' . $subject . '</title>
          </head>
          <body>
            Hello " . htmlspecialchars($toUsername) . " </br>
            Click here to </br>
            " . $url . "
          </body>
        </html>
        ";
        mail($toAddr, $subject, $message, $headers);
      }
}