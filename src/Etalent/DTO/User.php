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
    private $nome, $sobreNome, $sexo, $email, $login;

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobreNome()
    {
        return $this->sobreNome;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSobreNome($sobreNome)
    {
        $this->sobreNome = $sobreNome;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLogin()
    {
        return $this->login;
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