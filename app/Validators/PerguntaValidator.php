<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PerguntaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'descricao'       => 'required|max:255',
            'tipo'            => 'required',
            'questionario_id' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'descricao'       => 'required|max:255',
            'tipo'            => 'required',
            'questionario_id' => 'required',
        ],
   ];
}
