<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TurmaValidator extends LaravelValidator
{

    protected $rules = [
        'descricao' => 'required|max:255',
        'nivel' => 'required',
        'professor' => 'required|max:255'
    ];
}
