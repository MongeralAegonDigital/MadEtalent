<?php

namespace Madetalent\Etalentsoap\Etalent\DTO;

/**
 * This class are responsiable to set some user informations
 * @since 2016-05-19
 * @version 1.0
 * @author Jonathan Iqueda <jonathaniqueda@me.com>
 */
class User
{

    private $name, $finalName, $sex, $email, $login;

    public function getName()
    {
        return $this->name;
    }

    public function getFinalName()
    {
        return $this->finalName;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setFinalName($finalName)
    {
        $this->finalName = $finalName;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }
}