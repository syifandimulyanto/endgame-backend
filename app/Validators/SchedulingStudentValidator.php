<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SchedulingStudentValidator.
 *
 * @package namespace App\Validators;
 */
class SchedulingStudentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'student_id' => 'required',
            'schedule_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'student_id' => 'required',
            'schedule_id' => 'required'
        ],
    ];
}
