<?php

namespace Madetalent\Etalentsoap\Etalent\Factory;

use \Madetalent\Etalentsoap\Etalent\Strategy\StrategyCreation\RetornarQuestionario;

/**
 * Description of UserCreationFactory
 *
 * @author developer02
 */
class StrategyFactory
{
    /*
     * @return \Strategy\UserCreation\UserCreation 
     */

    public static function get($strategy)
    {
        $types = [
            'retornar_questionario' => RetornarQuestionario::class,
        ];

        if (empty($types[$strategy])) {
            throw new ValidateException(['strategy' => 'Tipo de perfil nao implementado']);
        }

        $reflection = new \ReflectionClass($types[$strategy]);

        return $reflection->newInstanceArgs();
    }
}