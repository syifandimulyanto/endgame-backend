<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    // sentinel cartalyst model
    // Cartalyst\Sentinel\Users\EloquentUser

    const SUPER_ADMIN = 'superadmin';

    use Notifiable;
    use SoftDeletes;
    use Uuids;
    use Notifiable;
    use HasApiTokens;

    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];

    protected static $rolesModel = 'Cartalyst\Sentinel\Roles\EloquentRole';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'permissions',
        'last_login',
        'password',
        'parent_type',
        'parent_id'
    ];

    public function roles()
    {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

}
