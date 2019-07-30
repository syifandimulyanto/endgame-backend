<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSentinel extends \Cartalyst\Sentinel\Users\EloquentUser
{
    use Uuids;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'last_login'
    ];

    protected $loginNames = ['email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

}
