<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CourseValidator.
 *
 * @package namespace App\Validators;
 */
class StudentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nrp' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nrp' => 'required'
        ],
    ];
}
