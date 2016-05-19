<?php

namespace Madetalent\Etalentsoap\Etalent\Soap;

/**
 * This class are responsiable to send the soap request to etalent
 * @since 2016-05-12
 * @version 1.0
 * @author Jonathan Iqueda <jonathaniqueda@me.com>
 */
class SoapCustomRequest extends \SoapClient
{

    public $server;

    public function __construct($wsdl, $user, $password, $options)
    {
        parent::__construct($wsdl, $options);

        $login = ['Login' => $user, 'Senha' => $password];

        $headerLogin = new \SoapHeader('http://e-talent.com.br/', 'Consumer', $login);
        $this->__setSoapHeaders($headerLogin);

        $this->server = new \SoapServer($wsdl, $options);
    }

    public function __doRequest($request, $location, $action, $version, $one_way = NULL)
    {
        return parent::__doRequest($request, $location, $action, $version, $one_way);
    }

    public function call($service, $arguments = [])
    {
        return $this->__soapCall($service, $arguments);
    }

    public function xml2json($xmlString)
    {
        $start_tree = (array) simplexml_load_string($xmlString);

        $final_tree = array ();

        $this->loopRecursivelyForAttributes($start_tree, $final_tree);

        return $final_tree;
    }

    public function loopRecursivelyForAttributes($start_tree, &$final_tree)
    {
        foreach ($start_tree as $key1 => $row1) {
            if (!array_key_exists($key1, $final_tree)) {
                $final_tree[$key1] = array ();
            }

            if (array_key_exists('@attributes', $row1)) {
                $row1 = (array) $row1;

                $this->getValues($start_tree, $final_tree, $key1, $row1);
            } else {

                foreach ($row1 as $row2) {
                    $row2 = (array) $row2;

                    $this->getValues($start_tree, $final_tree, $key1, $row2);
                }
            }
        }
    }

    public function getValues($start_tree, &$final_tree, $key1, $row2)
    {
        foreach ($row2 as $key3 => $val3) {
            $val3 = (array) $val3;

            if ($key3 == '@attributes') {
                $final_tree[$key1][] = $val3;
            } else {
                $temp_parent = array ();

                $temp_parent[$key3] = $val3;

                $this->loopRecursivelyForAttributes($temp_parent, $final_tree[$key1][count($final_tree[$key1]) - 1]);
            }
        }
    }
}