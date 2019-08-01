<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ScheduleValidator.
 *
 * @package namespace App\Validators;
 */
class ScheduleValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'course_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'course_id' => 'required'
        ],
    ];
}
