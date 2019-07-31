<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ClassValidator.
 *
 * @package namespace App\Validators;
 */
class ClassValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required'
        ],
    ];
}
