<?php

namespace Madetalent\Etalentsoap\Etalent;

use Madetalent\Etalentsoap\Etalent\Factory\StrategyFactory;
use \SoapWrapper;

class ManagerEtalentStrategy
{

    public $soapConnection;

    public function __construct($wsdlUrl, $user, $password)
    {
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:e="http://e-talent.com.br/">
   <soapenv:Header>
      <e:Consumer>
         <!--Optional:-->
         <e:Login>ws_mongeral</e:Login>
         <!--Optional:-->
         <e:Senha>desenv</e:Senha>
      </e:Consumer>
   </soapenv:Header>
   <soapenv:Body>
      <e:RetornarQuestionario/>
   </soapenv:Body>
</soapenv:Envelope>';

        $soapBody = new \SoapVar($xml, \XSD_ANYXML);

        $soap = new \SoapClient($wsdlUrl, array ('trace' => true));
        $header[] = new \SoapHeader('Consumer', 'Login', $user);
        $header[] = new \SoapHeader('Consumer', 'Senha', $password);
        $soap->__setSoapHeaders($header);
        dd($soap->__soapCall('RetornarQuestionario', array ($soapBody)));

        // Add a new service to the wrapper
        $this->soapConnection = SoapWrapper::add(function ($service) use ($wsdlUrl, $user, $password) {
                    $service->name('etalent')
                            ->wsdl($wsdlUrl)
                            ->trace(true)
                            ->header('Consumer', 'Login', $user)
                            ->header('Consumer', 'Senha', $password)
                            ->cache(WSDL_CACHE_NONE);
                });

        // Using the added service
        SoapWrapper::service('etalent', function ($service) {
            dd($service->get());
            $service->call('RetornarQuestionario');
        });
    }

    public function create(Request $request)
    {
        $param = $request->all();

        $strategyClass = StrategyFactory::get($param['strategy']);

        return $strategyClass->create($request);
    }

    public function get(Request $request)
    {
        $param = $request->all();

        $strategyClass = StrategyFactory::get($param['strategy']);

        return $strategyClass->get($request);
    }

    public function send(Request $request)
    {
        $param = $request->all();

        $strategyClass = StrategyFactory::get($param['strategy']);

        return $strategyClass->send($request);
    }
}