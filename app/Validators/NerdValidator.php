<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class NerdValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:nerds',
            'nerd_level' =>'required|',
        ],
        ValidatorInterface::RULE_UPDATE => [],

   ];
}
