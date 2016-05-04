<?php

namespace Madetalent\Etalentsoap\Etalent\Strategy\StrategyCreation;

use Illuminate\Http\Request;

/**
 * UserCreation
 *
 * @author Jonathan Iqueda
 */
abstract class StrategyCreation
{

    public function create(Request $request);

    public function get(Request $request);

    public function save(Request $request);

    abstract public function validate(Request $request);
}