<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AlunoValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome_completo'  => 'required|max:255',
            'matricula'      => 'required|max:255',
            'email'          => 'required|email|unique:alunos',
            'data_nacimento' => 'date|required',
            'cpf'            => 'required',
            'turmas_id'      => 'required',
            'logradouro'     => 'max:255',
            'complemento'    => 'max:255',
            'bairro'         => 'max:100',
            'cidade'         => 'max:100',
            'estado'         => 'max:2'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'data_nacimento' => 'date|required',
        ],
   ];
}
