<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SliderValidator.
 *
 * @package namespace App\Validators;
 */
class SliderValidator extends LaravelValidator
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
