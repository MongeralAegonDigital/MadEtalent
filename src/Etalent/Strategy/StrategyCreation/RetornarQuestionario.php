<?php

namespace Madetalent\Etalentsoap\Etalent\Strategy\StrategyCreation;

use Illuminate\Http\Request;
use App\Custom\Exception\ValidateException;
use App\Custom\Request\RequestMessage;
use Validator;

/**
 * CandidateCreation
 *
 * @author Jonathan Iqueda
 */
class RetornarQuestionario extends StrategyCreation
{

    public function get(Request $request)
    {
        return RequestMessage::success('cheguei');
    }

    public function validate(Request $request)
    {
        $validate = Validator::make($request->all(), [
                    'profile_type_name' => 'required|in:superintendente,diretor_comercial,rh,comissoes,master,gerente,coted,candidate',
                    'user.name' => 'required|regex:/([A-Za-zÀ-Úà-ú]{2,})\s([A-Za-zÀ-Úà-ú]{2,})/',
                    'user.cpf' => 'regex:/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/|validateCpf|unique:user',
                    'user.username' => 'required|string',
                    'user.email' => 'required|email|confirmed',
        ]);

        if ($validate->fails()) {
            throw new ValidateException($validate->errors());
        }
    }
}