<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentScheduleChangeValidator.
 *
 * @package namespace App\Validators;
 */
class StudentScheduleChangeValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'schedule_id' => 'required',
            'room_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'schedule_id' => 'required',
            'room_id' => 'required'
        ],
    ];
}
