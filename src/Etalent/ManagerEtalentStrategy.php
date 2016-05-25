<?php

namespace Madetalent\Etalentsoap\Etalent;

use Exception;
use Madetalent\Etalentsoap\Etalent\DTO\Questions as EtalentQuestions;
use Madetalent\Etalentsoap\Etalent\DTO\User as EtalentUser;
use madetalent\etalentsoap\Etalent\Soap\SoapCustomRequest;
use SoapFault;
use stdClass;

class ManagerEtalentStrategy extends SoapCustomRequest
{
    protected $exception = "Infelizmente não conseguimos processar sua requisição. Tente novamente mais tarde.";

    public function __construct($wsdlUrl, $user, $pass)
    {
        parent::__construct($wsdlUrl, $user, $pass,
            [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true, 'exceptions' => true]);
    }

    public function getRetornarQuestionario()
    {
        // Make the request
        try {
            $request = $this->call('RetornarQuestionario');

            if (isset($request->RetornarQuestionarioResult)) {
                return $this->xml2json($request->RetornarQuestionarioResult->any);
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function setGravarCandidatoEtalent(EtalentUser $user)
    {
        // Make the request
        try {
            $request = $this->call('GravarCandidatoEtalent', [$user]);

            if (isset($request->GravarCandidatoEtalentResult->RealizadoComSucesso)
                && $request->GravarCandidatoEtalentResult->RealizadoComSucesso) {
                return $request->GravarCandidatoEtalentResult;
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function setGraverPerfilEtalentVendas(EtalentQuestions $questions)
    {
        // Make the request
        try {
            $request = $this->call('GravarPerfilEtalentVendas', [$questions]);

            if (isset($request->GravarPerfilEtalentVendasResult->any)) {
                $result = (array) simplexml_load_string($request->GravarPerfilEtalentVendasResult->any);
                return $result;
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getMiniRelatorio($etalentUserId)
    {
        $user         = new stdClass();
        $user->userId = $etalentUserId;

        // Make the request
        try {
            $request = $this->call('RetornarMiniRelatorio', [$user]);

            if (isset($request->RetornarMiniRelatorioResult->any)) {
                $result = (array) simplexml_load_string($request->RetornarMiniRelatorioResult->any);
                return $result;
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}