<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CourseValidator.
 *
 * @package namespace App\Validators;
 */
class ProgramStudyValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'code' => 'required',
            'name' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'code' => 'required',
            'name' => 'required'
        ],
    ];
}
