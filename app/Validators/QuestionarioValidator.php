<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;


class QuestionarioValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'titulo' => 'required|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'titulo' => 'required|max:255'
        ],
   ];
    
}
