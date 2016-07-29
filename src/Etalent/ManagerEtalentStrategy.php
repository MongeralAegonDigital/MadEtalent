<?php

namespace MadEtalent\EtalentSoap\Etalent;

use Exception;
use MadEtalent\EtalentSoap\Etalent\DTO\Questions as EtalentQuestions;
use MadEtalent\EtalentSoap\Etalent\DTO\User as EtalentUser;
use MadEtalent\EtalentSoap\Etalent\Soap\SoapCustomRequest;
use SoapFault;
use stdClass;

class ManagerEtalentStrategy extends SoapCustomRequest
{
    protected $exception = "Infelizmente não conseguimos processar sua requisição. Tente novamente mais tarde.";

    public function __construct($wsdlUrl, $user, $pass)
    {
        parent::__construct($wsdlUrl, $user, $pass, [ 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => true, 'exceptions' => true]);
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

            if (isset($request->GravarCandidatoEtalentResult->RealizadoComSucesso) && $request->GravarCandidatoEtalentResult->RealizadoComSucesso) {
                return $request->GravarCandidatoEtalentResult;
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function setGravarPerfilEtalentVendas(EtalentQuestions $questions)
    {
        // Make the request
        try {
            $request = $this->call('GravarPerfilEtalentVendas', [$questions]);

            if (isset($request->GravarPerfilEtalentVendasResult->any)) {
                $result = (array) simplexml_load_string($request->GravarPerfilEtalentVendasResult->any);
                $result = $this->object_to_array($result);
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

    public function getRetornaCorrelacaoCandidatos($etalentUserId)
    {
        $user         = new stdClass();
        $user->userid = $etalentUserId;

        // Make the request
        try {
            $request = $this->call('RetornaCorrelacaoCandidatos', [$user]);

            if (isset($request->RetornaCorrelacaoCandidatosResult->any)) {

                $matches       = [];
                $etalentGrades = $request->RetornaCorrelacaoCandidatosResult->any;
                preg_match_all('/(?<=<User>).*?(?=<Cargo>)/imx', $etalentGrades, $matches);
                $matches       = isset($matches[0]) ? $matches[0] : $matches;

                foreach ($matches as $v) {
                    $etalentGrades = str_replace($v, "<id>$v</id>", $etalentGrades);
                }

                $result = $this->parse($etalentGrades);
                return isset($result['User']) ? $result['User'] : 'Nenhum resultado encontrado';
            } else {
                throw new Exception($this->exception);
            }
        } catch (SoapFault $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public static function parse($contents)
    {
        $contents  = str_replace(array("\n", "\r", "\t"), '', $contents);
        $contents  = trim(str_replace('"', "'", $contents));
        $simpleXml = simplexml_load_string($contents);
        $json      = json_encode($simpleXml);

        return json_decode($json, true);
    }
}