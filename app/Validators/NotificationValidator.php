<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class NotificationValidator.
 *
 * @package namespace App\Validators;
 */
class NotificationValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required'
        ],
    ];
}
