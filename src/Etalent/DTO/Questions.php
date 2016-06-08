<?php

namespace MadEtalent\EtalentSoap\Etalent\DTO;

use stdClass;

/**
 * This class are responsiable to set some user informations
 * @since 2016-05-19
 * @version 1.0
 * @author Jonathan Iqueda <jonathaniqueda@me.com>
 */
class Questions
{
    private $arMais, $arMenos, $userId;

    public function __construct()
    {
        $this->arMais  = new stdClass();
        $this->arMenos = new stdClass();
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getArMais()
    {
        return $this->arMais;
    }

    public function getArMenos()
    {
        return $this->arMenos;
    }

    public function setArMais($arMais)
    {
        $this->arMais->string[] = $arMais;
    }

    public function setArMenos($arMenos)
    {
        $this->arMenos->string[] = $arMenos;
    }
}