<?php

namespace Madetalent\Etalentsoap\Etalent;

use madetalent\etalentsoap\Etalent\Factory\StrategyFactory;
use madetalent\etalentsoap\Etalent\Soap\SoapCustomRequest;

class ManagerEtalentStrategy extends SoapCustomRequest
{

    protected $exception = "Infelizmente não conseguimos processar sua requisição. Tente novamente mais tarde.";

    public function __construct($wsdlUrl, $user, $pass)
    {
        parent::__construct($wsdlUrl, $user, $pass, [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true, 'exceptions' => true]);
    }

    public function getQuestionario()
    {
        // Make the request
        try {
            $request = $this->call('RetornarQuestionario', []);

            if (isset($request->RetornarQuestionarioResult)) {
                return $this->xmlToJsonConvert($request->RetornarQuestionarioResult);
            } else {
                throw new \Exception($this->exception);
            }
        } catch (\SoapFault $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}