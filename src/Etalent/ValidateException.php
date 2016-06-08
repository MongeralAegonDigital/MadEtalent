<?php

namespace MadEtalent\EtalentSoap\Etalent;

use \Exception;

/**
 * Retorna a validação dos campos
 */
class ValidateException extends Exception
{

    private $dataField;

    public function __construct($dataField, $message = '', $code = 0, Exception $previous = null)
    {
        $this->dataField = $dataField;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the value of Data Field
     *
     * @return mixed
     */
    public function getDataField()
    {
        return $this->dataField;
    }
}