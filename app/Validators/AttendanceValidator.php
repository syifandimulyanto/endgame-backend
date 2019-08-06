<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AttendanceValidator.
 *
 * @package namespace App\Validators;
 */
class AttendanceValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'student_schedule_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'student_schedule_id' => 'required'
        ],
    ];
}
